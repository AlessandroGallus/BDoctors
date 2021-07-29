<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

    $doctors = User::with('specializations','sponsors','reviews')
        ->orderBy('users.id','desc')
        ->paginate(5);

    return response()->json($doctors);
}

    public function home(){

     $doctors = User::with('specializations','sponsors','reviews')
        ->orderBy('users.id','desc')
        ->get();
        
    /* dd($doctors[22]->sponsors); */
        foreach ($doctors as $doctor) {
            /* dd($doctor->sponsors); */
            $today= date("Y-m-d");
            $d1today= date_create($today);
            $d2exp= date_create($doctor['sponsors'][0]->getOriginal()['pivot_expiring_date']);
            $interval = date_diff($d1today,$d2exp);
            $diff = $interval->format('%R%a');
            if($diff<0){
                $doctor->sponsors()->sync([1=>['expiring_date'=>date('Y-m-d H:i:s',1753682930)]]);
            }
        }
    $updatedDoctors = User::with('specializations','sponsors','reviews')
    ->orderBy('users.id','desc')
    ->get();    
      return response()->json($updatedDoctors);
    }


 /*    public function getDocWithSpec($spec,$city){
    $doctors = User::join('specialization_user','users.id','=','specialization_user.user_id')
        ->select('users.name AS username',
                'sponsors.name AS sponsor_name',
                'specializations.name AS spec_name',
                'url_img'
        )
        /* ->where('users.city','=','Milano') 
        ->join('specializations','specialization_user.specialization_id','=','specializations.id')
        ->join('user_sponsor','users.id','=','user_sponsor.user_id')
        ->join('sponsors','user_sponsor.sponsor_id','=','sponsors.id')
        ->where('specializations.name','=',$spec)
        ->where('users.city','=',$city)
        ->orderBy('users.id','desc')
        /* ->groupBy('users.id') 
        ->get();

    return response()->json($doctors);
} */
public function getCities(){
    $cities = DB::table('users')->select('city')->distinct()->orderBy('users.city','asc')->get();
    return response()->json($cities);
}
public function getDoctorById($id){
    $doctor = User::with('specializations','reviews')->where('users.id','=',$id)->first();
    return response()->json($doctor);
}

public function getDoctors(Request $request){

    $doctors = User::with('specializations','sponsors','reviews')
        ->orderBy('users.id','desc')
        ->get();
        foreach ($doctors as $doctor) {
            /* dd($doctor->sponsors); */
            $today= date("Y-m-d");
            $d1today= date_create($today);
            $d2exp= date_create($doctor['sponsors'][0]->getOriginal()['pivot_expiring_date']);
            $interval = date_diff($d1today,$d2exp);
            $diff = $interval->format('%R%a');
            if($diff<0){
                $doctor->sponsors()->sync([1=>['expiring_date'=>date('Y-m-d H:i:s',1753682930)]]);
            }
        }

    $doctors = User::with(['specializations','sponsors','reviews'])->orderBy('users.id','desc')->paginate(5);
    /* if($request->has('spec-name')){
        $filtered = [];
        foreach ($doctors as $doctor) {
            foreach ($doctor['specializations'] as $spec) {
                if($spec['name']==$request->input('spec-name')){
                    array_push($filtered,$doctor);
                }
            }
        }
        return response()->json($filtered);
    } */
    if($request->has('specname')){
        $tosearch = $request->input('specname');
        $doctors = User::with('specializations','reviews','sponsors')->whereHas('specializations',function(Builder $query) use ($tosearch){
            $query->where('name','=',$tosearch);
        })->paginate(5);
    }
    if($request->has('premium')){
        $tosearch=$request->input('premium');
        $doctors = User::with('specializations','reviews','sponsors')->whereHas('sponsors',function(Builder $query){
            $query->where('sponsor_level','>','1');
        })->paginate(5);
    }
    return response()->json($doctors);
}
}
