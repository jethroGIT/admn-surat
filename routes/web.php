<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SLulusController;

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
    return view('auth.index');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


Route::get('/dashboard', function(){
    return view ('layout.layout');
});


// Route User
Route::middleware(['auth'])->group(function () {
    // Routes Profile
    Route::get('/profile', [ProfilController::class, 'index'])->name('profile');

    // Routes User
    Route::middleware(['userAkses:0,1,2'])->group(function () {
        Route::get('kelola-user/{tipe}', [UserController::class, 'index'])->name('indexUser');
        Route::get('kelola-user/{tipe}/{username}/view', [UserController::class, 'show'])->name('showUser');
    });

    Route::middleware(['userAkses:0,2'])->group(function () {
        Route::get('kelola-user/{tipe}/create', [UserController::class, 'create'])->name('createUser');
        Route::post('kelola-user/{tipe}/store', [UserController::class, 'store'])->name('storeUser');
        Route::get('kelola-user/{tipe}/{username}/edit', [UserController::class, 'edit'])->name('editUser');
        Route::post('kelola-user/{tipe}/{username}/update', [UserController::class, 'update'])->name('updateUser');
        Route::delete('kelola-user/{tipe}/{username}/destroy', [UserController::class, 'destroy'])->name('destroyUser');
    });

    //Routes Surat Keterangan Lulus
    Route::get('/surat-lulus', [SLulusController::class, 'index'])->name('surat-lulus');
    
    Route::middleware(['userAkses:0,3'])->group(function () {
        Route::get('/surat-lulus/create', [SLulusController::class, 'create'])->name('createSuratLulus');
        Route::post('/surat-lulus/store', [SLulusController::class, 'store'])->name('storeSuratLulus');
    });

    Route::middleware(['userAkses:0,1'])->group(function () { 
        Route::post('/surat-lulus/{id}/update', [SLulusController::class, 'update'])->name('updateSuratLulus');
    });
    
    Route::middleware(['userAkses:0'])->group(function () {
        Route::delete('/surat-lulus/{id}/destroy', [SLulusController::class, 'destroy'])->name('destroySuratLulus');
    });
    
    Route::middleware(['userAkses:0,2'])->group(function () {
        Route::post('/surat-lulus/{id}/upload', [SLulusController::class, 'upload'])->name('uploadSuratLulus');
    });

    Route::get('/surat-lulus/{id}/view', [SLulusController::class, 'show'])->name('showSuratLulus');
    Route::get('/surat-lulus/{id}/download', [SLulusController::class, 'download'])->name('downloadSuratLulus');

    
});


// Route::get('/test', function () {
//     return Storage::disk('public')->url('a.pdf');
//     return Storage::disk('public')->get('a.txt');
// });

Route::get('/reset-sLulus', [SLulusController::class, 'resetIncrement'])->name('resetSuratLulus');