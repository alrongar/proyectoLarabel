<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ConfirmAccountController extends Controller
{
    public function confirmarCuenta($token)
    {
        $confirmation = DB::table('user_confirmations')->where('token', $token)->first();

        if (!$confirmation) {
            return redirect()->route('login')->with('error', 'Token de confirmación inválido.');
        }

        $user = User::find($confirmation->user_id);
        $user->email_verified_at = now();
        $user->email_confirmed = 1;
        $user->save();

        DB::table('user_confirmations')->where('token', $token)->delete();

        return redirect()->route('login')->with('status', 'Correo confirmado. Esperando la activación por parte del administrador.');
    }
}
