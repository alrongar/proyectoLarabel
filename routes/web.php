<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiginController;
use Illuminate\Support\Facades\Route;

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
    return view('index');
});


//sigin 
Route::get('/sigin',[RegisterController::class,'crear'] );
Route::post('/sigin',[RegisterController::class,'store']);


//login
Route::get('/login',[LoginController::class,'loguear'] );
Route::post('/login',[LoginController::class,'store'] );



