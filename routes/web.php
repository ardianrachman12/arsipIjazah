<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IjazahController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::post('/store', [StudentController::class, 'store'])->name('students.store');
        Route::put('/update/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    });

    Route::prefix('ijazah')->group(function () {
        Route::get('/', [IjazahController::class, 'index'])->name('ijazah.index');
        Route::post('/store', [IjazahController::class, 'store'])->name('ijazah.store');
        Route::put('/update/{id}', [IjazahController::class, 'update'])->name('ijazah.update');
        Route::delete('/delete/{id}', [IjazahController::class, 'destroy'])->name('ijazah.destroy');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
