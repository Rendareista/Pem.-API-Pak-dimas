<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukkanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('home',[
        'title' => 'Laravel 11 | API'
    ]);
})->name('home')->middleware('guest');

//Route Register
Route::get('register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('register', [UserController::class, 'register_store']);

//Route login
Route::get('login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [UserController::class, 'login_authenticate']); //nama bebas bagian autenticate
Route::post('logout', [UserController::class, 'logout'])->middleware('auth'); //nama bebas bagian autenticate

//Route Dashboard
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


//Route Pemasukan
Route::get('dashboard/pemasukkan/filter', [PemasukkanController::class, 'index'])->name('filter')->middleware('auth');
Route::resource('dashboard/pemasukkan', PemasukkanController::class)->middleware('auth');

//Route Pengeluaran
Route::get('dashboard/pengeluaran/filter', [PengeluaranController::class, 'index'])->name('filter')->middleware('auth');
Route::resource('dashboard/pengeluaran', PengeluaranController::class)->middleware('auth');

