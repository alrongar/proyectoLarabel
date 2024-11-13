@extends('layouts.app')

@section('content')
<div class="dashboard">
    <div class="dashboard__card">
        <div class="dashboard__body">
            <h1 class="dashboard__title">Tus Eventos</h1>

            @if ($events->isEmpty())
                <p>No has creado ningún evento.</p>
            @else
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $event->image_url) }}" class="card-img-top"
                                    alt="Imagen del evento" width="100%" height="100%">
                                <div class="card-body">
                                    <h5 class="card-title">{{ Str::limit($event->title, 25) }}</h5>
                                    <!--<p class="card-text">{{ Str::limit($event->description, 80) }}</p>-->
                                    <p><strong>Categoría:</strong> {{ $event->category->name }}</p>
                                    <!--<p><small>Creado el: {{ $event->created_at->format('d/m/Y H:i') }}</small></p>-->

                                </div>
                            </div>
                            <div class="button-container">
                                <a href="{{ route('organizer.edit', $event->id) }}" class="btn btn-warning">✏️</a>
                                <form action="{{ route('organizer.delete', $event->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            <div class="create-event-container">
                <a href="{{ route('organizer.create') }}" class="create-event-btn">Crear evento</a>
            </div>
        </div>
    </div>
</div>
@endsection