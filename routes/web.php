<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;

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

Route::get('/home',[App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/admin/users',[UserController::class,'index'])->middleware('auth','admin');
Route::put('/users/{user}/activate',[UserController::class,'activate'])->name('users.activate');
Route::put('/users/{user}/deactivate',[UserController::class,'deactivate'])->name('users.deactivate');
Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.destroy');



Route::get('/profile/{id}', [UserController::class, 'edit'])->name('profile.edit')->middleware('admin');
Route::post('/profile/{id}', [UserController::class, 'update'])->name('profile.update')->middleware('admin');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users')->middleware('auth','admin');




//Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');




