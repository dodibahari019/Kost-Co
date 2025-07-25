<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\SewaKamarController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\TKamarController;
use App\Http\Controllers\TProfileController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::controller(AuthController::class)->group(function(){
    Route::get('/loginUser', 'loginView');
    Route::get('/registerUser', 'registerView');
    Route::post('/login-user', 'login');
    Route::get('/login-user', 'loginView')->name('login');
    Route::post('/logout', 'logout');
    Route::put('/hash-password', 'hash');
    // Route::get('/login', 'loginView');
});

Route::middleware(['auth'])->group(function () {
    // SEMUA ROUTE YANG BOLEH DIAKSES SETELAH LOGIN OLEH SEMUA TIPE USER 
    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'logout');
    });
    Route::controller(TProfileController::class)->group(function(){
        Route::get('/profile-penghuni', 'index');
        // DATATABLE
        Route::get('/profile-penghuni/viewProfilePenghuni', 'viewProfilePenghuni');
        Route::get('/profile-penghuni/getViewProfilePenghuni', 'getViewProfilePenghuni');
        Route::get('/profile-penghuni/dataTableViewProfilePenghuni', 'dataTableViewProfilePenghuni');
        Route::get('/profile-penghuni/cardViewProfilePenghuni', 'cardViewProfilePenghuni');
    });

    Route::middleware(['pengurus'])->group(function () {
        Route::controller(HomeController::class)->group(function(){
            Route::get('/', 'index');
        });

        Route::controller(PenghuniController::class)->group(function(){
            Route::get('/pengelolaan-penghuni', 'index');
            // DATATABLE
            Route::get('/pengelolaan-penghuni/viewPenghuni', 'viewPenghuni');
            Route::get('/pengelolaan-penghuni/getViewPenghuni', 'getViewPenghuni');
            Route::get('/pengelolaan-penghuni/dataTableViewPenghuni', 'dataTableViewPenghuni');
            Route::get('/pengelolaan-penghuni/isidataTableViewPenghuni', 'isidataTableViewPenghuni');
            // CRUD
            Route::get('/pengelolaan-penghuni/edit/{idPenghuni}', 'edit');
            Route::put('/pengelolaan-penghuni/update/{idPenghuni}', 'update');
        });

        Route::controller(KamarController::class)->group(function(){
            Route::get('/pengelolaan-kamar', 'index');
            // DATATABLE
            Route::get('/pengelolaan-kamar/viewKamar', 'viewKamar');
            Route::get('/pengelolaan-kamar/getViewKamar', 'getViewKamar');
            Route::get('/pengelolaan-kamar/dataTableViewKamar', 'dataTableViewKamar');
            Route::get('/pengelolaan-kamar/isidataTableViewKamar', 'isidataTableViewKamar');
            // CRUD
            Route::get('/pengelolaan-kamar/create', 'create');
            Route::get('/pengelolaan-kamar/getLastNomorKamar', 'getLastNomorKamar');
            Route::post('/pengelolaan-kamar/store', 'store');
            Route::get('/pengelolaan-kamar/edit/{idKamar}', 'edit');
            Route::put('/pengelolaan-kamar/update/{idKamar}', 'update');
            Route::delete('/pengelolaan-kamar/delete/{idKamar}', 'destroy');
        });

        Route::controller(SewaKamarController::class)->group(function(){
            Route::get('/pengelolaan-sewa-kamar', 'index');
            // DATATABLE
            Route::get('/pengelolaan-sewa-kamar/viewSewaKamar', 'viewSewaKamar');
            Route::get('/pengelolaan-sewa-kamar/getViewSewaKamar', 'getViewSewaKamar');
            Route::get('/pengelolaan-sewa-kamar/dataTableViewSewaKamar', 'dataTableViewSewaKamar');
            Route::get('/pengelolaan-sewa-kamar/isidataTableViewSewaKamar', 'isidataTableViewSewaKamar');
            // CRUD
            Route::get('/pengelolaan-sewa-kamar/edit/{idSewaKamar}', 'edit');
            Route::put('/pengelolaan-sewa-kamar/update/{idSewaKamar}', 'update');
        });

        Route::controller(DendaController::class)->group(function(){
            Route::get('/pengelolaan-denda', 'index');
            // DATATABLE
            Route::get('/pengelolaan-denda/viewDenda', 'viewDenda');
            Route::get('/pengelolaan-denda/getViewDenda', 'getViewDenda');
            Route::get('/pengelolaan-denda/dataTableViewDenda', 'dataTableViewDenda');
            Route::get('/pengelolaan-denda/isidataTableViewDenda', 'isidataTableViewDenda');
            // CRUD
            Route::get('/pengelolaan-denda/edit/{idDenda}', 'edit');
            Route::put('/pengelolaan-denda/update/{idDenda}', 'update');
        });
    });

    Route::middleware(['penghuni'])->group(function () {
        Route::controller(TKamarController::class)->group(function(){
            Route::get('/list-kamar', 'index');
            // DATATABLE
            Route::get('/list-kamar/viewListKamar', 'viewListKamar');
            Route::get('/list-kamar/getViewListKamar', 'getViewListKamar');
            Route::get('/list-kamar/dataTableViewListKamar', 'dataTableViewListKamar');
            Route::get('/list-kamar/cardViewListKamar', 'cardViewListKamar');
        });
    });
});

require __DIR__.'/auth.php';
