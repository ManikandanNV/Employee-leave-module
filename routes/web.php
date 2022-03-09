<?php

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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/apply-leave', [App\Http\Controllers\HomeController::class, 'applyLeave'])->name('apply-leave');
Route::get('/leave-balance', [App\Http\Controllers\HomeController::class, 'leaveBalance'])->name('leave-balance');
Route::get('/leaves', [App\Http\Controllers\HomeController::class, 'leaves'])->name('leaves');
Route::post('/save', [App\Http\Controllers\HomeController::class, 'save'])->name('save');
Route::get('/approve/{id}', [App\Http\Controllers\HomeController::class, 'approve'])->name('approve');
Route::post('/decline', [App\Http\Controllers\HomeController::class, 'decline'])->name('decline');