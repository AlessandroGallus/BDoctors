<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditRequest;
use App\Specialization;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Support\Facades\Storage;
=======
>>>>>>> 7a2e4f814360b2a3a142bc7d72ff329f1a14d676
=======
>>>>>>> 7a2e4f814360b2a3a142bc7d72ff329f1a14d676

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $to_edit = User::find($id);
        $userspec = $to_edit->specializations;
        $specializations = Specialization::all();
        return view('Admin.edit',compact('to_edit','specializations','userspec')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request, $id)
    {
        $to_update = User::find($id);
        $data= $request->all();
        $url_img = Storage::put('uploads', $data['url_img']);
        $data['url_img']=$url_img;
        /* dd($data); */
        $to_update->update($data);
        $to_update->specializations()->sync($data['specializations']);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        Auth::logout();
        $user->delete();
        return redirect()->route('login');

    }
}
