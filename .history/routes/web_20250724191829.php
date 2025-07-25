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
    Route::middleware(['admin'])->group(function () {
        Route::controller(SettingUserController::class)->group(function(){
            // MAIN
            route::get('/setting-user', 'index')->name('settingUsers');

            // DATATABLE
            route::get('/setting-user/viewDataTable', 'viewDataTable');
            route::get('/setting-user/settingUserDataTable', 'settingUserDataTable');
            route::get('/setting-user/dataTableView', 'dataTableView');
            route::get('/setting-user/isidataTableView', 'isidataTableView');

            //CRUD
            route::get('/seting user/create', 'create');
            route::post('/seting user/store', 'store');
            route::get('/seting user/edit/{userId}', 'edit');
            route::put('/seting user/update/{userId}', 'update');
            route::delete('/setting-user/delete/{userId}', 'destroy');
        });

        Route::controller(VoucherController::class)->group(function(){
            // MAIN
            route::get('/master-voucher', 'index');

            // DATATABLE
            route::get('/master-voucher/viewDataTable', 'viewDataTable');
            route::get('/master-voucher/settingUserDataTable', 'settingUserDataTable');
            route::get('/master-voucher/dataTableView', 'dataTableView');
            route::get('/master-voucher/isidataTableView', 'isidataTableView');

            //CRUD
            route::get('/master-voucher/create', 'create');
            route::post('/master-voucher/store', 'store');
            route::get('/master-voucher/edit/{idVoucher}', 'edit');
            route::put('/master-voucher/update/{idVoucher}', 'update');
            route::delete('/master-voucher/delete/{idVoucher}', 'destroy');
        });

        Route::controller(MasterProductController::class)->group(function(){
            route::get('/master-product', 'index');
            route::get('/master-product/viewDataTable', 'viewDataTable');
            route::get('/master-product/productUserDataTable', 'productUserDataTable');
            route::get('/master-product/dataTableView', 'dataTableView');
            route::get('/master-product/isidataTableView', 'isidataTableView');

            //CRUD Product
            route::get('/master-product/create', 'create');
            route::post('/master-product/store', 'store');
            route::get('/master-product/edit/{idProduct}', 'edit');
            route::put('/master-product/update/{idProduct}', 'update');
            route::delete('/master-product/delete/{idProduct}', 'destroy');
        });

        Route::controller(MasterCategoryController::class)->group(function(){
            // MAIN
            route::get('/master-category', 'index');

            // DATATABLE
            route::get('/master-category/viewDataTable', 'viewDataTable');
            route::get('/master-category/masterCategoryDataTable', 'masterCategoryDataTable');
            route::get('/master-category/dataTableView', 'dataTableView');
            route::get('/master-category/isidataTableView', 'isidataTableView');

            //CRUD
            route::get('/master-category/create', 'create');
            route::post('/master-category/store', 'store');
            route::get('/master-category/edit/{idKategori}', 'edit');
            route::put('/master-category/update/{idKategori}', 'update');
            route::delete('/master-category/delete/{idKategori}', 'destroy');
        });

        Route::controller(MasterUOMController::class)->group(function(){
            // MAIN
            route::get('/master-uom', 'index');

            // DATATABLE
            route::get('/master-uom/viewDataTable', 'viewDataTable');
            route::get('/master-uom/masterUomDataTable', 'masterUomDataTable');
            route::get('/master-uom/dataTableView', 'dataTableView');
            route::get('/master-uom/isidataTableView', 'isidataTableView');

            //CRUD
            route::get('/master-uom/create', 'create');
            route::post('/master-uom/store', 'store');
            route::get('/master-uom/edit/{idKemasan}', 'edit');
            route::put('/master-uom/update/{idKemasan}', 'update');
            route::delete('/master-uom/delete/{idKemasan}', 'destroy');
        });
    });
});

require __DIR__.'/auth.php';
