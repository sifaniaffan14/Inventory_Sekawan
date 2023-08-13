<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\manager\DashboardManagerController as DashboardManager;
use App\Http\Controllers\direktur\DashboardDirekturController as DashboardDirektur;
use App\Http\Controllers\direktur\VerifikasiDirekturController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\manager\VerifikasiManagerController;
use App\Http\Controllers\PemesananController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('protectedPage:1')->group(function () {
    // Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin-dashboard',[DashboardAdminController::class, 'admin'])->name('admin-dashboard');

    Route::controller(DashboardAdminController::class)->name('admin-dashboard.')->prefix('admin-dashboard')->group(function () {
        $route = array('getData','chartPemesanan');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
    Route::controller(KendaraanController::class)->name('kendaraan.')->prefix('kendaraan')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
    Route::controller(DriverController::class)->name('driver.')->prefix('driver')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
    Route::controller(DivisiController::class)->name('divisi.')->prefix('divisi')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
    Route::controller(KaryawanController::class)->name('karyawan.')->prefix('karyawan')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete', 'getData');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
    Route::controller(PemesananController::class)->name('pemesanan.')->prefix('pemesanan')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete', 'getData','onDownload');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
});

Route::middleware('protectedPage:2')->group(function () {
    Route::get('/dashboard-direktur',[DashboardDirektur::class, 'index'])->name('dashboard-direktur');
    Route::controller(VerifikasiDirekturController::class)->name('verifikasiPemesanan.')->prefix('verifikasiPemesanan')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete', 'getData');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
});

Route::middleware('protectedPage:3')->group(function () {
    Route::get('/dashboard',[DashboardManager::class, 'index'])->name('dashboard');
    Route::controller(VerifikasiManagerController::class)->name('verifikasi.')->prefix('verifikasi')->group(function () {
        $route = array('index', 'insert', 'update','select', 'delete', 'getData');  
        foreach ($route as $route) {
            Route::any($route=='index'?'':'/'.$route, $route)->name($route);
        }
    });
});
