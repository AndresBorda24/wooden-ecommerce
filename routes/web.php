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

Route::get('/', \App\Http\Controllers\HomeController::class)->name('home');

Route::get('/product-search//', [\App\Http\Controllers\Products\ProductController::class, 'search'])->name('products.search');
Route::get('/product/{product:slug}', [\App\Http\Controllers\Products\ProductController::class, 'show'])->name('products.show');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/productos', \App\Http\Livewire\Admin\Products\Index::class)->name('products');
        Route::get('/usuarios', \App\Http\Livewire\Admin\Users\Index::class)->name('users');
    });
});
