<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loguear(Request $request){
        return view("auth.login");
    }

    public function store(Request $request)
    {

    }
}
