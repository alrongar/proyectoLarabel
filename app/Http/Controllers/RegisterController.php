<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        dd($request->all());
        // Validar los campos del formulario
        $request->validate([
            'name' => 'required|string|max:255',              // Nombre requerido, tipo string, máximo 255 caracteres
            'email' => 'required|string|email|max:255|unique:users',  // Email requerido, tipo string, formato de email, máximo 255 caracteres y único en la tabla users
            'password' => 'required|string|min:8|confirmed',  // Contraseña requerida, mínimo 8 caracteres, debe ser confirmada (necesita campo password_confirmation)
            'password_confirmation' => 'required|string|min:8',  // Confirmación de contraseña requerida
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',  // Imagen opcional, debe ser un archivo de imagen, máximo 2MB
            'rol' => 'required|in:u,o',   // Rol requerido, debe ser 'u' para usuario o 'o' para organizador (radio button o checkbox)
        ]);

        $imagePath = '';  

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash para la contraseña
            'image' => $imagePath,  // Guardar la ruta de la imagen
            'rol' => $request->rol,
        ]);

        // Redirigir con mensaje de éxito
        return back()->with('success', 'Usuario registrado correctamente.');
    }
}
