<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('guest.index');
    }

    public function sponsor(){
        return view('Admin.sponsor');
    }
}
