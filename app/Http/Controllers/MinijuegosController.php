<?php

namespace App\Http\Controllers;
use App\Models\minijuegos;

use Illuminate\Http\Request;

class MinijuegosController extends Controller
{
    public function index(){
        
        $minijuegos = minijuegos::all();

        return view('/user_comun/index', compact('minijuegos'));

    }
}
