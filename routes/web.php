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
use App\Http\Controllers\Client\ProfileClientController;
use App\Http\Controllers\Client\ProposalMitraClientController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;

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


// Login Dan Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index']);



/* Pengunjung */
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
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/adminstrator/dashboard', [DashboardController::class, 'index'])->name('dashboardadmin');

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
});

/* Owner */
Route::middleware(['auth', 'user-access:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardowner');

});

/* HRD */
Route::middleware(['auth', 'user-access:hrd'])->group(function () {
    Route::get('/hrd/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardhrd');
});


/* Manajer */
Route::middleware(['auth', 'user-access:manajer'])->group(function () {
    Route::get('/manajer/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardmanajer');
});

/* Karyawan */
Route::middleware(['auth', 'user-access:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardkaryawan');
});



/* Client */
Route::middleware(['auth', 'user-access:client'])->group(function () {
    Route::get('/client/profile', [ProfileClientController::class, 'index'])->name('profileclient');

    Route::get('/client/kerjasama', [ProposalMitraClientController::class, 'index'])->name('pengajuankerjasama');

    Route::get('/client/statuskerjasama', [ProposalMitraClientController::class, 'statuskerjasama'])->name('statuskerjasama');

    Route::get('/client/home', [HomeController::class, 'index']);

    // Tentang PT Raja Perkasa
    Route::get('/client/tentang', [TentangController::class, 'index'])->name('tentang');

    // Jasa PT Raja Perkasa
    Route::get('/client/jasa', [JasaController::class, 'index'])->name('jasa');

    // Project PT Raja Perkasa
    Route::get('/client/project', [ProjectController::class, 'index']);

    // Kontak PT Raja Perkasa
    Route::get('/client/kontak', [KontakController::class, 'index']);
});