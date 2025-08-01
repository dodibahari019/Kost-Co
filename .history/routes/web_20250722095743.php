<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\KamarController;

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::controller(AuthController::class)->group(function(){
    Route::get('/loginPenghuni', 'loginView');
});

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
    Route::get('/kamar', 'index');
    // DATATABLE
    Route::get('/kamar/viewPenghuni', 'viewPenghuni');
    Route::get('/kamar/getViewPenghuni', 'getViewPenghuni');
    Route::get('/kamar/dataTableViewPenghuni', 'dataTableViewPenghuni');
    Route::get('/kamar/isidataTableViewPenghuni', 'isidataTableViewPenghuni');
    // CRUD
    Route::get('/kamar/edit/{idPenghuni}', 'edit');
    Route::put('/kamar/update/{idPenghuni}', 'update');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
