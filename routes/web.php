<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MahasiswaController;

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

Route::get('/dashboard', function(){
    return view ('layout.layout');
});

// Routes User
Route::get('user/{role}/create', [UserController::class, 'create']);
Route::post('user/{role}/store', [UserController::class, 'store']);


// Routes Mahasiswa
Route::get('kelola-mahasiswa', [MahasiswaController::class, 'index'])->name('indexMahasiswa');
Route::get('kelola-mahasiswa/{nrp}/create', [MahasiswaController::class, 'create'])->name('createMahasiswa');
Route::post('kelola-mahasiswa/store', [MahasiswaController::class, 'store']);
