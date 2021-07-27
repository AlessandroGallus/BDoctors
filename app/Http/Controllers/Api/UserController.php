<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

    $doctors = User::with('specializations','sponsors')
        ->orderBy('users.id','desc')
        ->paginate(5);

    return response()->json($doctors);
}

    public function home(){

     $doctors = User::with('specializations','sponsors')
        ->orderBy('users.id','desc')

        ->get();

      return response()->json($doctors);
    }


    public function getDocWithSpec($spec,$city){
    $doctors = User::join('specialization_user','users.id','=','specialization_user.user_id')
        ->select('users.name AS username',
                'sponsors.name AS sponsor_name',
                'specializations.name AS spec_name',
                'url_img'
        )
        /* ->where('users.city','=','Milano') */
        ->join('specializations','specialization_user.specialization_id','=','specializations.id')
        ->join('user_sponsor','users.id','=','user_sponsor.user_id')
        ->join('sponsors','user_sponsor.sponsor_id','=','sponsors.id')
        ->where('specializations.name','=',$spec)
        ->where('users.city','=',$city)
        ->orderBy('users.id','desc')
        /* ->groupBy('users.id') */
        ->get();

    return response()->json($doctors);
}
public function getCities(){
    $cities = DB::table('users')->select('city')->distinct()->orderBy('users.city','asc')->get();
    return response()->json($cities);
}
public function getDoctorById($id){
    $doctor = User::with('specializations')->where('users.id','=',$id)->first();
    return response()->json($doctor);
}
}
