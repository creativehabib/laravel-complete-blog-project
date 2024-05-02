<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['prefix' => 'admin', 'middleware'=>'auth'],function (){
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);

    Route::resource('media', MediaController::class);
    Route::post('/getMediaById', [MediaController::class, 'getMediaById'])->name('media.getMediaById');
    Route::post('/mediaUpdate', [MediaController::class, 'mediaUpdate'])->name('backend.mediaUpdate');

//    Route::post('/getMediaById', [MediaController::class, 'getMediaById'])->name('getMediaById');
//    Route::get('/', [MediaController::class, 'index'])->name('media.index');
//    Route::post('/store', [MediaController::class, 'store'])->name('admin.store');


});


require __DIR__.'/auth.php';

Route::get('/{any}', function () {
    return view('auth.login');
})->where('any','.*');
