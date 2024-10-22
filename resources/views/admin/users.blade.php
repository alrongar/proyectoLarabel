@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <h1>Usuarios desactivados</h1>

                    @if (session('status'))
                        <div>{{ session('status') }}</div>
                    @endif

                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <!-- Mostrar botón de "Activar" solo para usuarios desactivados -->
                                        @if(!$user->actived)
                                            <form action="{{ route('users.activate', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Activar</button>
                                            </form>
                                        @else
                                            <!-- Mostrar botón de "Borrar" solo para usuarios activados -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
