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
use App\Http\Controllers\Hrd\DashboardController as HrdDashboardController;
use App\Http\Controllers\Manajer\DashboardController as ManajerDashboardController;
use App\Http\Controllers\Manajer\ManajerProyekListProyekController;
use App\Http\Controllers\Manajer\ManajerProyekMaterialsController;
use App\Http\Controllers\Manajer\ManajerProyekPeralatanController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;


Route::get('/', function () {
    return redirect('/home');
});


// Login Dan Register
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('login-proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/confirm-email', [RegisterController::class, 'confirmEmail'])->name('confirmEmail');
Route::get('/get-pic-details', [RegisterController::class, 'getPicDetails'])->name('getpicdetails');
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
    /* Users Client External */
    Route::get('/adminstrator/users/client', [UsersAdminController::class, 'getclient'])->name('userslisteclient');
    Route::get('/adminstrator/users/client/show/{id}', [UsersAdminController::class, 'showclient'])->name('showclient');
    Route::get('/adminstrator/users/client/kerjasama/{id}', [UsersAdminController::class, 'getKerjasamaData'])->name('getKerjasamaData');
    Route::post('/adminstrator/users/client/edit/{id}', [UsersAdminController::class, 'editclientproses'])->name('userslistclienteditproses');
    Route::post('/adminstrator/users/client/update-status/{id}', [UsersAdminController::class, 'updateStatusUser'])->name('updateStatusUser');
    Route::delete('/adminstrator/users/client/delete/{id}', [UsersAdminController::class, 'deleteClient'])->name('userslistclientdelete');

    /* Users Internal Karyawan PT Raja Perkasa */
    Route::get('/adminstrator/users', [UsersAdminController::class, 'index'])->name('userslist');
    Route::get('/adminstrator/userscreate', [UsersAdminController::class, 'create'])->name('userscreate');
    Route::post('/adminstrator/userscreateproses', [UsersAdminController::class, 'createproses'])->name('userscreateproses');
    Route::get('/adminstrator/users/show/{id}', [UsersAdminController::class, 'showpegawai'])->name('showpegawai');
    Route::get('/adminstrator/usersedit/{id}', [UsersAdminController::class, 'edit'])->name('usersedit');
    Route::put('/adminstrator/userupdate/{id}', [UsersAdminController::class, 'update'])->name('userupdate');
    Route::delete('/adminstrator/users/delete/{id}', [UsersAdminController::class, 'deletepegawai'])->name('userslistpegawaidelete');

    // Proyek
    Route::get('/adminstrator/proyek', [ProyekAdminController::class, 'index'])->name('proyeklist');
    Route::get('/adminstrator/listdataproyek/show/{id}', [ProyekAdminController::class, 'adminstratorshowlistdataproyek'])->name('adminstratorshowlistdataproyek');
    Route::get('/adminstrator/listdataproyek/{id}/edit', [ProyekAdminController::class, 'adminstratorlistdataproyekedit'])->name('adminstratorlistdataproyekedit');
    Route::post('/adminstrator/listdataproyek/update/{id}', [ProyekAdminController::class, 'adminstratorlistdataproyekupdate'])->name('adminstratorlistdataproyek.update');
    Route::get('/adminstrator/getProyekData/{id}', [ProyekAdminController::class, 'getProyekData'])->name('getProyekData');

    // ReportData
    Route::get('/adminstrator/report/proyek', [ReportAdminController::class, 'reportproyek'])->name('reportproyek');

    // Settings
    Route::get('/adminstrator/users/profile/edit/{id}', [UsersAdminController::class, 'editProfile'])->name('editusersprofile');
    Route::post('/adminstrator/users/profile/update/{id}', [UsersAdminController::class, 'updateprofile'])->name('updateusersprofile');

    Route::get('/adminstrator/settings', [SettingsController::class, 'index'])->name('settings');
});


/* Manajer Proyek */
Route::middleware(['auth', 'user-access:manajer'])->group(function () {
    Route::get('/manajer/dashboard', [ManajerDashboardController::class, 'index'])->name('dashboardmanajer');

   // Data Peralatans
   /* Peralatan */
   Route::get('/manajerproyek/peralatans', [ManajerProyekPeralatanController::class, 'peralatan'])->name('peralatanlist');
   Route::get('/manajerproyek/peralatans/create', [ManajerProyekPeralatanController::class, 'create'])->name('peralatancreate');
   Route::post('/manajerproyek/peralatans/createproses', [ManajerProyekPeralatanController::class, 'createproses'])->name('peralatancreateproses');
   Route::get('/manajerproyek/peralatans/{id}/edit', [ManajerProyekPeralatanController::class, 'edit'])->name('peralatanedit');
   Route::post('/manajerproyek/peralatans/update/{id}', [ManajerProyekPeralatanController::class, 'update'])->name('peralatan.update');
   Route::delete('/manajerproyek/peralatans/{id}', [ManajerProyekPeralatanController::class, 'delete'])->name('peralatandelete');

    /* Brand Peralatan */
    Route::get('/manajerproyek/brandperalatans', [ManajerProyekPeralatanController::class, 'brandperalatan'])->name('brandperalatanlist');
    Route::get('/manajerproyek/brandperalatans/create', [ManajerProyekPeralatanController::class, 'createbrand'])->name('brandperalatancreate');
    Route::post('/manajerproyek/brandperalatans/createproses', [ManajerProyekPeralatanController::class, 'createbrandproses'])->name('brandperalatancreateproses');
    Route::get('/manajerproyek/brandperalatans/{id}/edit', [ManajerProyekPeralatanController::class, 'editbrand'])->name('brandperalatanedit');
    Route::post('/manajerproyek/brandperalatans/update/{id}', [ManajerProyekPeralatanController::class, 'updatebrand'])->name('brandperalatan.update');
    Route::delete('/manajerproyek/brandperalatans/{id}', [ManajerProyekPeralatanController::class, 'deletebrand'])->name('brandperalatandelete');

     /* List Data Peralatan */
    Route::get('/manajerproyek/listdataperalatans', [ManajerProyekPeralatanController::class, 'listdataperalatan'])->name('listdataperalatan');
    Route::get('/adminstrator/listdataperalatans/show/{id}', [ManajerProyekPeralatanController::class, 'showlistdataperalatans'])->name('showlistdataperalatans');
    Route::get('/manajerproyek/listdataperalatans/create', [ManajerProyekPeralatanController::class, 'createlistdataperalatan'])->name('listdataperalatancreate');
    Route::post('/manajerproyek/listdataperalatans/createproses', [ManajerProyekPeralatanController::class, 'createlistdataperalatanproses'])->name('listdataperalatancreateproses');
     Route::get('/manajerproyek/listdataperalatans/{id}/edit', [ManajerProyekPeralatanController::class, 'editlistdataperalatan'])->name('listdataperalatanedit');
     Route::post('/manajerproyek/listdataperalatans/update/{id}', [ManajerProyekPeralatanController::class, 'updatelistdataperalatan'])->name('listdataperalatan.update');
     Route::delete('/manajerproyek/listdataperalatans/{id}', [ManajerProyekPeralatanController::class, 'deletelistdataperalatan'])->name('listdataperalatandelete');

   
    // Data Materials
    /* Materials */
    Route::get('/manajerproyek/materials', [ManajerProyekMaterialsController::class, 'materials'])->name('materialslist');
    Route::get('/manajerproyek/materials/create', [ManajerProyekMaterialsController::class, 'create'])->name('materialscreate');
    Route::post('/manajerproyek/materials/createproses', [ManajerProyekMaterialsController::class, 'createproses'])->name('materialscreateproses');
    Route::get('/manajerproyek/materials/{id}/edit', [ManajerProyekMaterialsController::class, 'edit'])->name('materialsedit');
    Route::post('/manajerproyek/materials/update/{id}', [ManajerProyekMaterialsController::class, 'update'])->name('materials.update');
    Route::delete('/manajerproyek/materials/{id}', [ManajerProyekMaterialsController::class, 'delete'])->name('materialsdelete');

     /* Brand Materials */
     Route::get('/manajerproyek/brandmaterials', [ManajerProyekMaterialsController::class, 'brandmaterials'])->name('brandmaterialslist');
     Route::get('/manajerproyek/brandmaterials/create', [ManajerProyekMaterialsController::class, 'brandcreate'])->name('brandmaterialscreate');
     Route::post('/manajerproyek/brandmaterials/createproses', [ManajerProyekMaterialsController::class, 'brandcreateproses'])->name('brandmaterialscreateproses');
     Route::get('/manajerproyek/brandmaterials/{id}/edit', [ManajerProyekMaterialsController::class, 'brandedit'])->name('brandmaterialsedit');
     Route::post('/manajerproyek/brandmaterials/update/{id}', [ManajerProyekMaterialsController::class, 'brandupdate'])->name('brandmaterials.update');
     Route::delete('/manajerproyek/brandmaterials/{id}', [ManajerProyekMaterialsController::class, 'branddelete'])->name('brandmaterialsdelete');

      /* List Data Materials */
      Route::get('/manajerproyek/listdatamaterials', [ManajerProyekMaterialsController::class, 'listdatamaterials'])->name('listdatamaterials');
      Route::get('/adminstrator/listdatamaterials/show/{id}', [ManajerProyekMaterialsController::class, 'showlistdatamaterials'])->name('showlistdatamaterials');
      Route::get('/manajerproyek/listdatamaterials/create', [ManajerProyekMaterialsController::class, 'listdatacreate'])->name('listdatamaterialscreate');
      Route::post('/manajerproyek/listdatamaterials/createproses', [ManajerProyekMaterialsController::class, 'listdatacreateproses'])->name('listdatamaterialscreateproses');
      Route::get('/manajerproyek/listdatamaterials/{id}/edit', [ManajerProyekMaterialsController::class, 'listdataedit'])->name('listdatamaterialsedit');
      Route::post('/manajerproyek/listdatamaterials/update/{id}', [ManajerProyekMaterialsController::class, 'listdataupdate'])->name('listdatamaterials.update');
      Route::delete('/manajerproyek/listdatamaterials/{id}', [ManajerProyekMaterialsController::class, 'listdatadelete'])->name('listdatamaterialsdelete');

        // Data Proyek
        Route::get('/manajerproyek/listdataproyek', [ManajerProyekListProyekController::class, 'listdataproyek'])->name('listdataproyek');
        Route::get('/manajerproyek/listdataproyek/show/{id}', [ManajerProyekListProyekController::class, 'showlistdataproyek'])->name('showlistdataproyek');
        Route::get('/manajerproyek/listdataproyek/create', [ManajerProyekListProyekController::class,'listdataproyekcreate'])->name('listdataproyekcreate');
        Route::post('/manajerproyek/listdataproyek/createproses', [ManajerProyekListProyekController::class, 'listdataproyekcreateproses'])->name('listdataproyekcreateproses');
       Route::get('/manajerproyek/listdataproyek/{id}/edit', [ManajerProyekListProyekController::class, 'listdataproyekedit'])->name('listdataproyekedit');
       Route::post('/manajerproyek/listdataproyek/update/{id}', [ManajerProyekListProyekController::class, 'listdataproyekupdate'])->name('listdataproyek.update');
       Route::delete('/manajerproyek/listdataproyek/{id}', [ManajerProyekListProyekController::class, 'listdataproyekdelete'])->name('listdataproyekdelete');
});


/* Client */
Route::middleware(['auth', 'user-access:client'])->group(function () {
    Route::get('/client/profile', [ProfileClientController::class, 'index'])->name('profileclient');
    Route::post('/client/profile/update/{id}', [ProfileClientController::class, 'update'])->name('profileupdate');

    Route::get('/client/kerjasama', [ProposalMitraClientController::class, 'index'])->name('pengajuankerjasama');
    Route::post('/client/kerjasama/submit', [ProposalMitraClientController::class, 'create'])->name('submitkerjasama');
    Route::post('/client/kerjasama/update/{id}', [ProposalMitraClientController::class, 'update'])->name('updatekerjasama');

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

/* HRD */
Route::middleware(['auth', 'user-access:hrd'])->group(function () {
    Route::get('/hrd/dashboard', [HrdDashboardController::class, 'index'])->name('dashboardhrd');
});

/* Karyawan */
Route::middleware(['auth', 'user-access:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardkaryawan');
});

/* Owner */
Route::middleware(['auth', 'user-access:owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboardowner');
});


