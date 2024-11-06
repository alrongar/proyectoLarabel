@extends('layouts.app')

@section('content')
<div class="event-page">
    <div class="event-form">
        <h3 class="event-form__title">{{ __('Editar Evento') }}</h3>
        <form method="POST" action="{{ route('organizer.update', $event->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Campo de Nombre -->
            <div class="event-form__field row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('título del Evento') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $event->title) }}" required
                        autofocus>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Campo de Descripción -->
            <div class="event-form__field row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control" name="description"
                        required>{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="event-form__field row mb-3">
                <label for="start_time" class="col-md-4 col-form-label text-md-end">Fecha de Inicio</label>
                <div class="col-md-6">
                    <input type="datetime-local" id="start_time" name="start_time" class="form-control"
                        value="{{ old('start_time', $event->start_time) }}" required>
                    @error('start_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="event-form__field row mb-3">
                <label for="end_time" class="col-md-4 col-form-label text-md-end">Fecha de Fin</label>
                <div class="col-md-6">
                    <input type="datetime-local" id="end_time" name="end_time" class="form-control"
                        value="{{ old('end_time', $event->end_time) }}" required>
                    @error('end_time')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="event-form__field row mb-3">
                <label for="location" class="col-md-4 col-form-label text-md-end">Ubicación</label>
                <div class="col-md-6">
                    <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $event->location) }}"
                        required>
                    @error('location')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Latitud -->
            <div class="event-form__field row mb-3">
            <div class="col-md-6">
                <label for="latitude" class="form-label">Latitud</label>
                <input type="text" name="latitude" id="latitude" class="form-control" value="{{ old('latitude', $event->latitude) }}" required>
            </div>
            <div class="col-md-6">
                <label for="longitude" class="form-label">Longitud</label>
                <input type="text" name="longitude" id="longitude" class="form-control" value="{{ old('longitude', $event->longitude) }}" required>
            </div>

            </div>

            <!-- Longitud -->
            

            <!-- Máximo de Asistentes -->
            <div class="event-form__field row mb-3">
                <label for="max_attendees" class="col-md-4 col-form-label text-md-end">Máximo de Asistentes</label>
                <div class="col-md-6">
                    <input type="number" id="max_attendees" name="max_attendees" class="form-control"
                        value="{{ old('max_attendees', $event->max_attendees) }}" required>
                    @error('max_attendees')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Precio -->
            <div class="event-form__field row mb-3">
                <label for="price" class="col-md-4 col-form-label text-md-end">Precio</label>
                <div class="col-md-6">
                    <input type="number" step="0.01" id="price" name="price" class="form-control"
                        value="{{ old('price', $event->price) }}">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Categoría -->
            <div class="event-form__field row mb-3">
                <label for="category_id" class="col-md-4 col-form-label text-md-end">Categoría</label>
                <div class="col-md-6">
                    <select id="category_id" name="category_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Campo para Subir Imagen -->
            <div class="event-form__field row mb-3">
                <label for="image_url" class="col-md-4 col-form-label text-md-end">{{ __('Imagen del Evento') }}</label>
                <div class="col-md-6">
                    <input id="image_url" type="file" name="image_url" class="form-control" accept="image/*">
                    @error('image_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botón de Envío -->
            <div class="event-form__footer row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="event-form__button btn btn-primary">
                        {{ __('Actualizar Evento') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection