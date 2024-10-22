<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::where('actived',0)->get();
        return view('admin.users',compact('users'));
    }
    
    public function activate (User $user){
        $user->update(['actived' => 1]);
        return redirect()->back()->with('success','Usuario activado');
    }

    public function deactivate (User $user){
        $user->update(['actived' => 0]);
        return redirect()->back()->with('success','Usuario desactivado');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect()->back()->with('success','Usuario eliminado');
    }
}
