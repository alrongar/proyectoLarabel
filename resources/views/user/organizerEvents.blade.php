@extends('layouts.app')

@section('content')
<div class="organizer-events-page">
    <h3>Tus Eventos</h3>
    <a href="{{ route('organizer.create') }}" class="btn btn-primary">Crear evento</a>
    @if ($events->isEmpty())
        <p>No has creado ningún evento.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->category }}</td>
                        <td>{{ $event->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection