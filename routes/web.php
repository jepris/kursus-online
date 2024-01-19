<?php

use App\Models\Siswa;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\CategoryController;
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

// Route::get('/', function () {
//     $data = Siswa::all();
//     return view('dashboard', compact('data'));
// });

Route::get('/', [KursusController::class, 'index']);
Route::get('/dashboard', [KursusController::class, 'index'])->name('dashboard');


// tambah data course
Route::get('/tambahdata', [KursusController::class, 'tambahdata'])->name('tambahdata')->middleware('admin');
Route::post('/insertdata', [KursusController::class, 'insertdata'])->name('insertdata');

// login
Route::get('/sesi',[UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/sesi/login',[UserController::class, 'login']);
Route::get('/sesi/logout',[UserController::class, 'logout']);

// register
Route::get('/sesi/register',[UserController::class, 'register'])->middleware('guest');
Route::post('/sesi/create',[UserController::class, 'create']);


//tambahdata siswa
Route::get('/tambahdatasiswa', [SiswaController::class, 'tambahdatasiswa'])->name('tambahdatasiswa')->middleware('auth');
Route::post('/insertdatasiswa', [SiswaController::class, 'insertdatasiswa'])->name('insertdatasiswa')->middleware('auth');

Route::get('/course', [CategoryController::class, 'index']);

// bagian About
Route::get('/about', function () {
    return view('about');
});

Route::middleware(['auth'])->group(function () {
    // Rute dashboard setelah login
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Rute untuk mendaftar ke kelas
    Route::post('/join/{kursusId}', [UserController::class, 'joinKursus'])->name('join.kursus');
    Route::get('/kursus/{kursusId}/users', [UserController::class, 'showKursusUsers'])->name('showKursusUsers');
});




// Route::post('/sesi/create',[SessionController::class, 'create']);
// Route::get('/course', function (Category $category) {
//     //$data = Category::all();

//     return view('course',[
//         'title'=> $category->name,
//         'kursus'=> $category->kursus,
//         'category'=>$category->name
//     ]);
//     //return view('course', compact('data'));
// });

// Route::get('/course', function (Category $cat) {
//     //$data = Category::all();
//     return view('course',[
//         'categories'=>Category::all(),
//     ]);
//     //return view('course', compact('data'));
// });