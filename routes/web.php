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
    return view('welcome');
});

Route::get('/product/{product}', function ($product) {
    $media = \App\Models\Product::find($product)->media()->get();

    $gallery = $media->map(function ($m) {
        return $m->getUrl();
    });

    $thumbnails = $media->map(function ($m) {
        return $m->getUrl('thumb');
    });

    // dd();
    return view('product', [
        'gallery'    => json_encode($gallery->toArray()),
        'thumbnails' => json_encode($thumbnails->toArray()),
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');


    /**
     * Admin routes
     */
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/productos', \App\Http\Livewire\Admin\Products\Index::class)->name('products');
        Route::get('/usuarios', \App\Http\Livewire\Admin\Users\Index::class)->name('users');
    });
});
