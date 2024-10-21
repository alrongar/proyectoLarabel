@extends('layouts.app')

@section('titulo')
    Principal
@endsection

@section('contenido')

<!-- ====================== SECCIÓN DE BIENVENIDA ====================== -->
<section class="welcome">
    <h2 class="welcome__title">¡Bienvenido a Eventify!</h2>
    <p class="welcome__text">
        Eventify te permite crear y unirte a los mejores eventos. ¿Eres organizador? ¡Regístrate y crea tu evento hoy! ¿Eres asistente? Únete y explora eventos increíbles.
    </p>
</section>

<!-- ====================== SECCIÓN DE ROLES ====================== -->
<section class="roles">
    <h3 class="roles__title">¿Qué rol tienes en Eventify?</h3>
    <div class="roles__options">
        <div class="roles__option roles__option--organizer">
            <h4 class="roles__option-title">Organizador</h4>
            <ul class="roles__option-list">
                <li class="roles__option-item">Crear y gestionar eventos</li>
                <li class="roles__option-item">Ver participantes inscritos</li>
                <li class="roles__option-item">Promocionar eventos</li>
            </ul>
        </div>
        <div class="roles__option roles__option--user">
            <h4 class="roles__option-title">Usuario Normal</h4>
            <ul class="roles__option-list">
                <li class="roles__option-item">Unirte a eventos</li>
                <li class="roles__option-item">Guardar eventos favoritos</li>
                <li class="roles__option-item">Recibir notificaciones</li>
            </ul>
        </div>
    </div>
</section>

<!-- ====================== SECCIÓN DE ACCIONES ====================== -->
<section class="actions">
    <a href="/login" class="actions__button">Iniciar Sesión</a>
    <a href="/sigin" class="actions__button actions__button--alt">Crear Cuenta</a>
</section>

@endsection

