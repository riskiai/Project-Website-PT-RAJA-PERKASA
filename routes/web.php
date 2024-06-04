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


Route::get('/', function () {
    return redirect('/home');
});


// Login Dan Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register_prosess', [RegisterController::class, 'registerproses'])->name('registerproses');



/* Pengunjung */
    // Beranda Home
    Route::get('/home', [HomeController::class, 'index']);

    // Tentang PT Raja Perkasa
    Route::get('/tentang', [TentangController::class, 'index'])->name('tentangpengunjung');

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
    Route::get('/adminstrator/tentangcreate', [TentangAdminController::class, 'create'])->name('tentangcreate');
    Route::post('/adminstrator/tentangcreateproses', [TentangAdminController::class, 'createproses'])->name('tentangcreateproses');
    Route::get('/administrator/tentang/{id}/edit', [TentangAdminController::class, 'edit'])->name('tentangedit');
    Route::post('/administrator/tentang/update/{id}', [TentangAdminController::class, 'update'])->name('tentang.update');
    Route::delete('/adminstratortentang/delete/{id}', [TentangAdminController::class, 'delete'])->name('tentangdelete');

    // Jasa 
    Route::get('/administrator/jasa', [JasaAdminController::class, 'index'])->name('jasalist');
    Route::get('/administrator/jasacreate', [JasaAdminController::class, 'create'])->name('jasacreate');
    Route::post('/administrator/jasacreateproses', [JasaAdminController::class, 'createproses'])->name('jasacreateproses');
    Route::get('/administrator/jasa/{id}/edit', [JasaAdminController::class, 'edit'])->name('jasaedit');
    Route::post('/administrator/jasa/update/{id}', [JasaAdminController::class, 'update'])->name('jasa.update');
    Route::delete('/administrator/jasa/{id}', [JasaAdminController::class, 'delete'])->name('jasadelete');

     // Kontak
     Route::get('/administrator/kontak', [KontakAdminController::class, 'index'])->name('kontaklist');
     Route::get('/administrator/kontakcreate', [KontakAdminController::class, 'create'])->name('kontakcreate');
     Route::post('/administrator/kontakcreateproses', [KontakAdminController::class, 'createproses'])->name('kontakcreateproses');     
     Route::get('/administrator/kontakedit/{id}/edit', [KontakAdminController::class, 'edit'])->name('kontakedit');
     Route::post('/administrator/kontak/update/{id}', [KontakAdminController::class, 'update'])->name('kontak.update');     
     Route::delete('/administrator/kontak/{id}', [KontakAdminController::class, 'delete'])->name('kontakdelete');

    // Proyek
    Route::get('/adminstrator/proyek', [ProyekAdminController::class, 'index'])->name('proyeklist');
    Route::get('/adminstrator/proyekcreate', [ProyekAdminController::class, 'store'])->name('proyekcreate');
    Route::get('/adminstrator/proyekedit', [ProyekAdminController::class, 'edit'])->name('proyekedit');

    // Mitra
    Route::get('/administrator/mitra', [MitraAdminController::class, 'index'])->name('mitralist');
    Route::get('/administrator/mitracreate', [MitraAdminController::class, 'create'])->name('mitracreate');
    Route::post('/administrator/mitracreateproses', [MitraAdminController::class, 'createproses'])->name('mitracreateproses');
    Route::get('/administrator/mitraedit/{id}/edit', [MitraAdminController::class, 'edit'])->name('mitraedit');
    Route::post('/administrator/mitra/update/{id}', [MitraAdminController::class, 'update'])->name('mitra.update');
    Route::delete('/administrator/mitra/{id}', [MitraAdminController::class, 'delete'])->name('mitradelete');

    // Testimoni
    Route::get('/administrator/testimoni', [TestimoniAdminController::class, 'index'])->name('testimonilist');
    Route::get('/administrator/testimonicreate', [TestimoniAdminController::class, 'create'])->name('testimonicreate');
    Route::post('/administrator/testimonicreateproses', [TestimoniAdminController::class, 'createproses'])->name('testimonicreateproses');
    Route::get('/administrator/testimoniedit/{id}/edit', [TestimoniAdminController::class, 'edit'])->name('testimoniedit');
    Route::post('/administrator/testimoni/update/{id}', [TestimoniAdminController::class, 'update'])->name('testimoni.update');
    Route::delete('/administrator/testimoni/{id}', [TestimoniAdminController::class, 'delete'])->name('testimonidelete');
   

    // Users
    Route::get('/adminstrator/users', [UsersAdminController::class, 'index'])->name('userslist');
    Route::get('/adminstrator/users/client', [UsersAdminController::class, 'getclient'])->name('userslisteclient');
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


/* Client */
Route::middleware(['auth', 'user-access:client'])->group(function () {
    Route::get('/client/profile', [ProfileClientController::class, 'index'])->name('profileclient');
    Route::post('/client/profile/update/{id}', [ProfileClientController::class, 'update'])->name('profileupdate');

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


