<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use Illuminate\Database\Query\IndexHint;
use App\Http\Controllers\AdminController;
use Illuminate\Routing\ViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application    . These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/',[SesiController::class, 'index']);
    Route::post('/',[SesiController::class, 'login'])->name('login');
});

Route::get('/home',function () {
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin',[AdminController::class, 'index']);
    Route::get('/admin/operator', [AdminController::class, 'operator'])->middleware('userAkses:operator');
    Route::get('/admin/keuangan', [AdminController::class, 'keuangan'])->middleware('userAkses:keuangan');
    Route::get('/admin/marketing', [AdminController::class, 'marketing'])->middleware('userAkses:marketing');
    Route::get('/logout', [SesiController::class, 'logout']);
});

Route::resource('/posts', \App\Http\Controllers\PostController::class);