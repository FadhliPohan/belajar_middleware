<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'role:admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');

    //semua route dalam grup ini hanya bisa diakses oleh operator
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');

    //semua route dalam grup ini hanya bisa diakses siswa
});


// Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'role:admin']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
