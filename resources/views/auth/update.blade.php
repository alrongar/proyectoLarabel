@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

                <div class="card-body">
                    <!-- Mostrar el nombre actual del usuario -->
                    <p><strong>Nombre actual:</strong> {{ $user->name }}</p>

                    <form action="{{ route('profile.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo de Nombre -->
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <!-- Botón de enviar -->
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

