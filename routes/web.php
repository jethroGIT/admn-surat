<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SLHSController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SAktifController;
use App\Http\Controllers\SLulusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SPengantarController;

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


// Route User
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes Profile
    Route::get('/profile', [ProfilController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfilController::class, 'update'])->name('updateProfile');
    Route::post('profile/update-password', [ProfilController::class, 'updatePassword'])->name('updatePassword');
    
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


    //Routes Surat
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


    //Routes Surat Laporan Hasil Studi
    Route::get('/surat-lhs', [SLHSController::class, 'index'])->name('surat-lhs');
    Route::get('/surat-lhs/create', [SLHSController::class, 'create'])->name('createSuratLHS');
    Route::post('/surat-lhs/store', [SLHSController::class, 'store'])->name('storeSuratLHS');
    Route::get('/surat-lhs/{id}/view', [SLHSController::class, 'show'])->name('showSuratLHS');
    Route::post('/surat-lhs/{id}/update', [SLHSController::class, 'update'])->name('updateSuratLHS');
    Route::delete('/surat-lhs/{id}/destroy', [SLHSController::class, 'destroy'])->name('destroySuratLHS');
    Route::post('/surat-lhs/{id}/upload', [SLHSController::class, 'upload'])->name('uploadSuratLHS');
    Route::get('/surat-lhs/{id}/download', [SLHSController::class, 'download'])->name('downloadSuratLHS');

    //Routes Surat Pengantar
    Route::get('/surat-pengantar', [SPengantarController::class, 'index'])->name('surat-pengantar');
    Route::get('/surat-pengantar/create', [SPengantarController::class, 'create'])->name('createSuratPengantar');
    Route::post('/surat-pengantar/store', [SPengantarController::class, 'store'])->name('storeSuratPengantar');
    Route::get('/surat-pengantar/{id}/view', [SPengantarController::class, 'show'])->name('showSuratPengantar');
    Route::post('/surat-pengantar/{id}/update', [SPengantarController::class, 'update'])->name('updateSuratPengantar');
    Route::delete('/surat-pengantar/{id}/destroy', [SPengantarController::class, 'destroy'])->name('destroySuratPengantar');
    Route::post('/surat-pengantar/{id}/upload', [SPengantarController::class, 'upload'])->name('uploadSuratPengantar');
    Route::get('/surat-pengantar/{id}/download', [SPengantarController::class, 'download'])->name('downloadSuratPengantar');

    //Routes Surat Aktif
    Route::get('/surat-aktif', [SAktifController::class, 'index'])->name('surat-aktif');
    Route::get('/surat-aktif/create', [SAktifController::class, 'create'])->name('createSuratAktif');
    Route::post('/surat-aktif/store', [SAktifController::class, 'store'])->name('storeSuratAktif');
    Route::get('/surat-aktif/{id}/view', [SAktifController::class, 'show'])->name('showSuratAktif');
    Route::post('/surat-aktif/{id}/update', [SAktifController::class, 'update'])->name('updateSuratAktif');
    Route::delete('/surat-aktif/{id}/destroy', [SAktifController::class, 'destroy'])->name('destroySuratAktif');
    Route::post('/surat-aktif/{id}/upload', [SAktifController::class, 'upload'])->name('uploadSuratAktif');
    Route::get('/surat-aktif/{id}/download', [SAktifController::class, 'download'])->name('downloadSuratAktif');
});


Route::get('/registrasi-admin', function () {
    return view('auth.registrasiAdmin');
})->name('register');

Route::post('kelola-user/{tipe}/store', [UserController::class, 'store'])->name('storeUser');


Route::get('/reset-sLulus', [SLulusController::class, 'resetIncrement'])->name('resetSuratLulus');
Route::get('/reset-sLHS', [SLHSController::class, 'resetIncrement'])->name('resetSuratLHS');
Route::get('/reset-sPengantar', [SPengantarController::class, 'resetIncrement'])->name('resetSuratPengantar');
Route::get('/reset-sAktif', [SAktifController::class, 'resetIncrement'])->name('resetSuratAktif');