<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('event.createEvent', compact('categories'));
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->rol !== 'o') {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }
        $events = Event::where('organizer_id', $user->id)->get(); // Obtener todos los eventos
        $categories = Category::all(); // Obtener todas las categorías
        return view('user.organizerEvents', compact('events', 'categories')); // Asegúrate de que la vista exista
    }

    public function filterByCategory($category)
    {
        $user = Auth::user();
        if ($user->rol !== 'o') {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }
        $events = Event::where('organizer_id', $user->id)
                        ->whereHas('category', function($query) use ($category) {
                            $query->where('name', $category);
                        })
                        ->get();
        $categories = Category::all();
        return view('user.organizerEvents', compact('events', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255', 
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->latitude = $request->latitude;
        $event->longitude = $request->longitude;
        $event->max_attendees = $request->max_attendees;
        $event->price = $request->price;

        // Manejar la imagen si se proporciona
        if ($request->hasFile('image_url')) {
            $event->image_url = $request->file('image_url')->store('images', 'public'); 
        }

        // Asociar el evento al usuario autenticado
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect()->route('organizer.create')->with('success', 'Evento creado exitosamente');
    }
}
