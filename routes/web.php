<?php

use App\Models\Siswa;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\CategoryController;
use App\Models\Kursus;

// use App\Models\Siswa;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['guest'])->group(function () {
    // Rute yang memerlukan login
    Route::get('/', [KursusController::class, 'index']);
    Route::get('/dashboard', [KursusController::class, 'index'])->name('dashboard');
    //course
    Route::get('/course', [CategoryController::class, 'index']);
    // bagian About
    Route::get('/about', function () {
        return view('about');
    });
    // login
    Route::get('/sesi',[UserController::class, 'index'])->name('login');
    Route::post('/sesi/login',[UserController::class, 'login']);
    Route::get('/sesi/logout',[UserController::class, 'logout']);
    // register
    Route::get('/sesi/register',[UserController::class, 'register']);
    Route::post('/sesi/create',[UserController::class, 'create']);
});

Route::middleware(['auth'])->group(function () {
    // Rute untuk mendaftar ke kelas
    Route::post('/join/{kursusId}', [UserController::class, 'joinKursus'])->name('join.kursus');
    Route::get('/kursus/{kursusId}/users', [UserController::class, 'showKursusUsers'])->name('showKursusUsers');
    Route::post('/kursus/{kursus}/exitkursus', [UserController::class, 'exitkursus'])->name('exit.kursus');
});

// Route::middleware(['admin'])->group(function () {
//     // Rute yang memerlukan admin
//     Route::get('/kursuses/create', [KursusController::class, 'create'])->name('kursuses.create');
//     Route::post('/kursuses', [KursusController::class, 'store'])->name('kursuses.store');
//     Route::get('/kursuses/{kursuses}/edit', [KursusController::class, 'edit'])->name('kursuses.edit');
//     Route::put('/kursuses/{kursuses}', [KursusController::class, 'update'])->name('kursuses.update');
//     Route::get('/kursuses', [KursusController::class, 'main'])->name('kursuses.main');
// });

// tambah data course
Route::get('/tambahdata', [KursusController::class, 'tambahdata'])->name('tambahdata')->middleware('admin');
Route::post('/insertdata', [KursusController::class, 'insertdata'])->name('insertdata');
Route::get('/kursus/{kursusId}/edit', [KursusController::class, 'edit'])->name('kursus.edit');
Route::put('/kursus/{kursusId}', [KursusController::class, 'update'])->name('kursus.update');
Route::delete('/kursus/{kursusId}', [KursusController::class, 'destroy'])->name('kursus.destroy');

//tambahdata siswa
Route::get('/tambahdatasiswa', [SiswaController::class, 'tambahdatasiswa'])->name('tambahdatasiswa')->middleware('auth');
Route::post('/insertdatasiswa', [SiswaController::class, 'insertdatasiswa'])->name('insertdatasiswa')->middleware('auth');

