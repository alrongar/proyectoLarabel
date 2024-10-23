<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostrar todos los usuarios desactivados
    public function index()
    {
        $users = User::where('deleted', 0)
            ->where('rol', '!=', 'a')
            ->get();

        return view('admin.users', compact('users'));
    }

    // Activar usuario
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->actived = 1;
        $user->save();
        return redirect()->back()->with('success', 'Usuario activado.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->actived = 0;
        $user->save();
        return redirect()->back()->with('success', 'Usuario desactivado.');
    }

    public function destroy(User $user)
    {
        $user->deleted = 1;
        $user->save();
        return redirect()->back()->with('success', 'Usuario eliminado.');
    }


    public function edit($id)
    {
        // Obtener el usuario por su ID o fallar si no existe
        $user = User::findOrFail($id);

        // Redirigir a la vista para actualizar el usuario
        return view('auth.update', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->save();


        return redirect()->route('admin.users')->with('success', 'Nombre actualizado exitosamente.');
    }


}