<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ConfirmAccountController;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// UserController - Admin
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users')->middleware('auth', 'admin');

// Activar/desactivar y eliminar usuarios
Route::put('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
Route::put('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Editar y actualizar perfil de usuario
Route::get('/profile/{id}', [UserController::class, 'edit'])->name('profile.edit')->middleware('admin');
Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update')->middleware('admin');

// Registro
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Confirmar cuenta con email
Route::get('/confirmar-cuenta/{token}', [ConfirmAccountController::class, 'confirmarCuenta']);

// Ruta para la pantalla de usuario
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');

//log out 
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/organizer/create', [EventController::class, 'create'])->name('organizer.create')->middleware('auth');
Route::post('/organizer', [EventController::class, 'store'])->name('organizer.store'); 
Route::get('/organizer', [EventController::class, 'index'])->name('organizer')->middleware('auth');

Route::get('/organizer/{id}/edit', [EventController::class, 'edit'])->name('organizer.edit');
Route::put('/organizer/{id}', [EventController::class, 'update'])->name('organizer.update');
Route::delete('/organizer/{id}', [EventController::class, 'delete'])->name('organizer.delete'); 
