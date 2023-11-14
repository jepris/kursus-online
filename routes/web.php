<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\SessionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [KursusController::class, 'index'])->name('dashboard');

// tambah data
Route::get('/tambahdata', [KursusController::class, 'tambahdata'])->name('tambahdata');
Route::post('/insertdata', [KursusController::class, 'insertdata'])->name('insertdata');

// login
Route::get('/sesi',[SessionController::class, 'index']);
Route::post('/sesi/login',[SessionController::class, 'login']);
Route::get('/sesi/logout',[SessionController::class, 'logout']);

// register
Route::get('/sesi/register',[SessionController::class, 'register']);
Route::post('/sesi/create',[SessionController::class, 'create']);