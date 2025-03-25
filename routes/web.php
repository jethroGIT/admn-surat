<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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
    return view('layout.layout');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/dashboard', function(){
    return view ('layout.layout');
});


// Route User
Route::get('kelola-user/{tipe}', [UserController::class, 'index'])->name('indexUser');
Route::get('kelola-user/{tipe}/create', [UserController::class, 'create'])->name('createUser');
Route::post('kelola-user/{tipe}/store', [UserController::class, 'store'])->name('storeUser');
Route::get('kelola-user/{tipe}/{username}/view', [UserController::class, 'show'])->name('showUser');
Route::delete('kelola-user/{tipe}/{username}/destroy', [UserController::class, 'destroy'])->name('destroyUser');

Route::get('/clear-session', function () {
    session()->flush();
    return redirect()->back();
});


