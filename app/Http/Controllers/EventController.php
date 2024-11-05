<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
    public function create()
    {
        return view('event.createEvent');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->rol !== 'o') {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }
        $events = Event::where('organizer_id', $user->id)->get(); // Obtener todos los eventos
        return view('user.organizerEvents', compact('events')); // Asegúrate de que la vista exista
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:Music,Sport,Tech',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->category = $request->category;

        // Manejar la imagen si se proporciona
        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('images', 'public'); // Asegúrate de configurar el sistema de archivos correctamente
        }

        // Asociar el evento al usuario autenticado
        $event->user_id = Auth::id();

        $event->save();

        return redirect()->route('organizer.create')->with('success', 'Evento creado exitosamente');
    }
}
