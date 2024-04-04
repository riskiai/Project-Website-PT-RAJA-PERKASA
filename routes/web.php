<?php

use App\Http\Controllers\Adminstrator\DashboardController;
use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\Autentikasi\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TentangController;
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
    return redirect('/home');
});

/* Pengunjung Website */
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/tentang', [TentangController::class, 'index']);
Route::get('/jasa', [JasaController::class, 'index']);
Route::get('/project', [ProjectController::class, 'index']);
Route::get('/kontak', [KontakController::class, 'index']);

/* Adminstrator */
Route::get('/adminstrator/dashboard', [DashboardController::class, 'index'])->name('dashboard');