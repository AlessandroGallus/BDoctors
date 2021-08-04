<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $doctors = User::with('specializations', 'sponsors', 'reviews')
        ->orderBy('users.id', 'desc')
        ->paginate(4);

        return response()->json($doctors);
    }

    public function home()
    {
        $doctors = User::with('specializations', 'sponsors', 'reviews')
        ->orderBy('users.id', 'desc')
        ->get();

        /* dd($doctors[22]->sponsors); */
        foreach ($doctors as $doctor) {
            /* dd($doctor->sponsors); */
            $today= date("Y-m-d");
            $d1today= date_create($today);
            $d2exp= date_create($doctor['sponsors'][0]->getOriginal()['pivot_expiring_date']);
            $interval = date_diff($d1today, $d2exp);
            $diff = $interval->format('%R%a');
            if ($diff<0) {
                $doctor->sponsors()->sync([1=>['expiring_date'=>date('Y-m-d H:i:s', 1753682930)]]);
            }
        }
        $updatedDoctors = User::with('specializations', 'sponsors', 'reviews')
    ->orderBy('users.id', 'desc')
    ->get();
        return response()->json($updatedDoctors);
    }

    public function getCities()
    {
        $cities = DB::table('users')->select('city')->distinct()->orderBy('users.city', 'asc')->get();
        return response()->json($cities);
    }
    public function getDoctorById($id)
    {
        $doctor = User::with('specializations', 'reviews')->where('users.id', '=', $id)->first();
        return response()->json($doctor);
    }

    public function getDoctors(Request $request)
    {

    /* AGGIORNAMENTE SCADENZE */
        $doctors = User::with('specializations', 'sponsors', 'reviews')
        ->orderBy('users.id', 'desc')
        ->get();
        foreach ($doctors as $doctor) {
            $today= date("Y-m-d");
            $d1today= date_create($today);
            $d2exp= date_create($doctor['sponsors'][0]->getOriginal()['pivot_expiring_date']);
            $interval = date_diff($d1today, $d2exp);
            $diff = $interval->format('%R%a');
            if ($diff<0) {
                $doctor->sponsors()->sync([1=>['expiring_date'=>date('Y-m-d H:i:s', 1753682930)]]);
            }
        }


    $doctors = User::with(['specializations','sponsors','reviews'])
    ->join('user_sponsor','user_sponsor.user_id','=','users.id')
    ->join('sponsors','sponsors.id','=','user_sponsor.sponsor_id')
    ->orderBy('sponsors.sponsor_level','desc')->paginate(4);

    if($request->has('specname') && $request->has('orderByCount')){
        $toSearchSpec = $request->input('specname');
        $doctors = User::withCount('reviews')
        ->whereHas('specializations',function(Builder $query) use ($toSearchSpec){
            $query->where('name','=',$toSearchSpec);
        })
        ->join('user_sponsor','user_sponsor.user_id','=','users.id')
        ->join('sponsors','sponsors.id','=','user_sponsor.sponsor_id')
        ->orderBy('sponsors.sponsor_level','desc')
        ->orderBy('reviews_count',$request->input('orderByCount'))->with('reviews','sponsors','specializations')
        ->paginate(4);
            return response()->json($doctors);
        }

        if ($request->has('specname') && $request->has('orderByAverage')) {
            $toSearchSpec = $request->input('specname');
            $toSearchOrder = $request->input('orderByAverage');
            $doctors = User::select('users.*', DB::raw('avg(reviews.vote) AS average'))
        ->with('specializations', 'reviews', 'sponsors')
        ->whereHas('specializations', function (Builder $query) use ($toSearchSpec) {
            $query->where('name', '=', $toSearchSpec);
        })
        ->join('user_sponsor','user_sponsor.user_id','=','users.id')
        ->join('sponsors','sponsors.id','=','user_sponsor.sponsor_id')
        ->join('reviews','reviews.user_id','=','users.id')
        ->groupBy('users.id')
        ->orderBy('sponsors.sponsor_level','desc')
        ->orderBy('average',$toSearchOrder)
        ->paginate(4);
        return response()->json($doctors);
    }

        if ($request->has('specname')) {
            $tosearch = $request->input('specname');
            $doctors = User::with('specializations', 'reviews', 'sponsors')->whereHas('specializations', function (Builder $query) use ($tosearch) {
                $query->where('name', '=', $tosearch);
            })->paginate(4);
        }
        if ($request->has('premium')) {
            $tosearch=$request->input('premium');
            $doctors = User::with('specializations', 'reviews', 'sponsors')->whereHas('sponsors', function (Builder $query) {
                $query->where('sponsor_level', '>', '1');
            })->paginate(4);
            return response()->json($doctors);
        }
        return response()->json($doctors);
    }
}
