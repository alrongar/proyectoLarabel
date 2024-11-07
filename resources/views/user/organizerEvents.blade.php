@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="dashboard">
        <div class="dashboard__card">
            <div class="dashboard__body">
                <h1 class="dashboard__title">Tus Eventos</h1>

                <div class="menu mb-3">
                    <ul>
                        <li>
                            <a href="#">Eventos</a>
                            <ul>
                                <li><a href="{{ route('events.filter', 'Music') }}">Música</a></li>
                                <li><a href="{{ route('events.filter', 'Sport') }}">Deporte</a></li>
                                <li><a href="{{ route('events.filter', 'Tech') }}">Tecnología</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('organizer.create') }}" class="btn btn-primary">Crear evento</a>
                @if ($events->isEmpty())
                    <p>No has creado ningún evento.</p>
                @else
                    <table class="dashboard__table">
                        <thead class="dashboard__table-header">
                            <tr>
                                <th class="dashboard__table-heading dashboard__table-heading--name">ID</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Nombre</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Descripción</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Categoría</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Fecha de Creación</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Imagen</th>
                                <th class="dashboard__table-heading dashboard__table-heading--name">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="dashboard__table-body">
                            @foreach ($events as $event)
                                <tr class="dashboard__table-row">
                                    <td class="dashboard__table-cell">{{ $event->id }}</td>
                                    <td class="dashboard__table-cell">{{ $event->title }}</td>
                                    <td class="dashboard__table-cell">{{ $event->description }}</td>
                                    <td class="dashboard__table-cell">{{ $event->category->name }}</td>
                                    <td class="dashboard__table-cell">{{ $event->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="dashboard__table-cell"><img src="{{ asset('storage/'.$event->image_url) }}"
                                            alt="Imagen del evento" width="200" height="200"></td>
                                    <td class="dashboard__table-cell">
                                        <!-- Botón de Editar -->
                                        <a href="{{ route('organizer.edit', $event->id) }}" class="btn btn-warning">Editar</a>

                                        <!-- Botón de Borrar -->
                                        <form action="{{ route('organizer.delete', $event->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection