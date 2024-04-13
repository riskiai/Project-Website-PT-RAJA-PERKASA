<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\Autentikasi\LoginController;
use App\Http\Controllers\Autentikasi\RegisterController;
use App\Http\Controllers\Adminstrator\SettingsController;
use App\Http\Controllers\Adminstrator\DashboardController;
use App\Http\Controllers\Adminstrator\JasaAdminController;
use App\Http\Controllers\Adminstrator\MitraAdminController;
use App\Http\Controllers\Adminstrator\UsersAdminController;
use App\Http\Controllers\Adminstrator\KontakAdminController;
use App\Http\Controllers\Adminstrator\ProyekAdminController;
use App\Http\Controllers\Adminstrator\ReportAdminController;
use App\Http\Controllers\Adminstrator\TentangAdminController;
use App\Http\Controllers\Adminstrator\TestimoniAdminController;

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

/* Pengunjung */
// Login Dan Register
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);

// Beranda Home
Route::get('/home', [HomeController::class, 'index']);

// Tentang PT Raja Perkasa
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

// Jasa PT Raja Perkasa
Route::get('/jasa', [JasaController::class, 'index'])->name('jasa');

// Project PT Raja Perkasa
Route::get('/project', [ProjectController::class, 'index']);

// Kontak PT Raja Perkasa
Route::get('/kontak', [KontakController::class, 'index']);


/* Adminstrator */
Route::get('/adminstrator/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Tentang
Route::get('/adminstrator/tentang', [TentangAdminController::class, 'index'])->name('tentanglist');
Route::get('/adminstrator/tentangcreate', [TentangAdminController::class, 'store'])->name('tentangcreate');
Route::get('/adminstrator/tentangedit', [TentangAdminController::class, 'edit'])->name('tentangedit');

// Jasa 
Route::get('/adminstrator/jasa', [JasaAdminController::class, 'index'])->name('jasalist');
Route::get('/adminstrator/jasacreate', [JasaAdminController::class, 'store'])->name('jasacreate');
Route::get('/adminstrator/jasaedit', [JasaAdminController::class, 'edit'])->name('jasaedit');

// Proyek
Route::get('/adminstrator/proyek', [ProyekAdminController::class, 'index'])->name('proyeklist');
Route::get('/adminstrator/proyekcreate', [ProyekAdminController::class, 'store'])->name('proyekcreate');
Route::get('/adminstrator/proyekedit', [ProyekAdminController::class, 'edit'])->name('proyekedit');

// Kontak
Route::get('/adminstrator/kontak', [KontakAdminController::class, 'index'])->name('kontaklist');
Route::get('/adminstrator/kontakcreate', [KontakAdminController::class, 'store'])->name('kontakcreate');
Route::get('/adminstrator/kontakedit', [KontakAdminController::class, 'edit'])->name('kontakedit');

// Mitra
Route::get('/adminstrator/mitra', [MitraAdminController::class, 'index'])->name('mitralist');
Route::get('/adminstrator/mitracreate', [MitraAdminController::class, 'store'])->name('mitracreate');
Route::get('/adminstrator/mitraedit', [MitraAdminController::class, 'edit'])->name('mitraedit');

// Testimoni
Route::get('/adminstrator/testimoni', [TestimoniAdminController::class, 'index'])->name('testimonilist');
Route::get('/adminstrator/testimonicreate', [TestimoniAdminController::class, 'store'])->name('testimonicreate');
Route::get('/adminstrator/testimoniedit', [TestimoniAdminController::class, 'edit'])->name('testimoniedit');

// Users
Route::get('/adminstrator/users', [UsersAdminController::class, 'index'])->name('userslist');
Route::get('/adminstrator/userscreate', [UsersAdminController::class, 'store'])->name('userscreate');
Route::get('/adminstrator/usersedit', [UsersAdminController::class, 'edit'])->name('usersedit');
Route::get('/adminstrator/users/profile', [UsersAdminController::class, 'editProfile'])->name('usersprofile');

// ReportData
Route::get('/adminstrator/report/proyek', [ReportAdminController::class, 'reportproyek'])->name('reportproyek');
Route::get('/adminstrator/report/jasa', [ReportAdminController::class, 'reportjasa'])->name('reportjasa');
Route::get('/adminstrator/report/mitra', [ReportAdminController::class, 'reportmitra'])->name('reportmitra');
Route::get('/adminstrator/report/testimoni', [ReportAdminController::class, 'reporttestimoni'])->name('reporttestimoni');
Route::get('/adminstrator/report/users', [ReportAdminController::class, 'reportusers'])->name('reportusers');

// Settings
Route::get('/adminstrator/settings', [SettingsController::class, 'index'])->name('settings');

