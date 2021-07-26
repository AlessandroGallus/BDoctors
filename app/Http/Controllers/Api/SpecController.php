<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Specialization;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function index(){
        $specs= Specialization::pluck('name');
       return response()->json($specs);
    }
}
