<?php

use App\Http\Controllers\ProfileController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('welcome-custom');
})->name('home')->middleware('auth');

Route::view('login-email', 'auth.login-email')->name('login.email')->middleware('guest');
Route::post('login-email', \App\Actions\SendMagicLink::class)->name('login.email')->middleware('guest');
Route::get('login/session/{user:email}', \App\Http\Controllers\Auth\EmailLoginController::class)->name('login.session')
    ->middleware(['guest', \App\Http\Middleware\ValidateSignature::class]);

Route::view('register-email', 'auth.register-email')->name('register.email')->middleware('guest');
Route::post('register-email', \App\Actions\SendMagicLink::class)->name('register.email')->middleware('guest');
Route::get('register/session/{name}/{email}', \App\Http\Controllers\Auth\EmailRegisterController::class)->name('register.session')
    ->middleware(['guest', \App\Http\Middleware\ValidateSignature::class]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
