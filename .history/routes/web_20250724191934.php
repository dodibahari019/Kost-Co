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



Route::controller(TKamarController::class)->group(function(){
    Route::get('/list-kamar', 'index');
    // DATATABLE
    Route::get('/list-kamar/viewListKamar', 'viewListKamar');
    Route::get('/list-kamar/getViewListKamar', 'getViewListKamar');
    Route::get('/list-kamar/dataTableViewListKamar', 'dataTableViewListKamar');
    Route::get('/list-kamar/cardViewListKamar', 'cardViewListKamar');
});

Route::controller(TProfileController::class)->group(function(){
    Route::get('/profile-penghuni', 'index');
    // DATATABLE
    Route::get('/profile-penghuni/viewProfilePenghuni', 'viewProfilePenghuni');
    Route::get('/profile-penghuni/getViewProfilePenghuni', 'getViewProfilePenghuni');
    Route::get('/profile-penghuni/dataTableViewProfilePenghuni', 'dataTableViewProfilePenghuni');
    Route::get('/profile-penghuni/cardViewProfilePenghuni', 'cardViewProfilePenghuni');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['pengurus'])->group(function () {
        
    });

    Route::middleware(['pengurus'])->group(function () {
        
    });
});

require __DIR__.'/auth.php';
