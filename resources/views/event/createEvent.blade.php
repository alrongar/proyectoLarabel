@extends('layouts.app')

@section('content')
<div class="event-page">
    <div class="event-form">
        <h3 class="event-form__title">{{ __('Crear Evento') }}</h3>
        <form method="POST" action="{{ route('organizer.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Campo de Nombre -->
            <div class="event-form__field row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre del Evento') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Campo de Descripción -->
            <div class="event-form__field row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>
                <div class="col-md-6">
                    <textarea id="description" class="form-control" name="description" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Campo de Categoría (Enumerado) -->
            <div class="event-form__field row mb-3">
                <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Categoría') }}</label>
                <div class="col-md-6">
                    <select id="category" class="form-control" name="category" required>
                        <option value="">{{ __('Selecciona una categoría') }}</option>
                        <option value="Music" {{ old('category') == 'musica' ? 'selected' : '' }}>{{ __('Música') }}</option>
                        <option value="Sport" {{ old('category') == 'deporte' ? 'selected' : '' }}>{{ __('Deporte') }}</option>
                        <option value="Tech" {{ old('category') == 'tecnologia' ? 'selected' : '' }}>{{ __('Tecnología') }}</option>
                    </select>
                    @error('category')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Campo para Subir Imagen -->
            <div class="event-form__field row mb-3">
                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Imagen del Evento') }}</label>
                <div class="col-md-6">
                    <input id="image" type="file" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Botón de Envío -->
            <div class="event-form__footer row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="event-form__button btn btn-primary">
                        {{ __('Crear Evento') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
