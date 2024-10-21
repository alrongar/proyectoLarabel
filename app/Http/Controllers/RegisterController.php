<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function crear()
    {
        return view("auth.sigin");
    }


    public function store(Request $request)
    {

    }


    
}
