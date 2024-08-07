<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Articles\ChannelController;
use App\Http\Controllers\Articles\VideoController;
use App\Http\Controllers\Articles\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::prefix('contents')->group(function (){
        Route::resource('channels', ChannelController::class);
        Route::get('/channels/{id}/remove', [ChannelController::class, 'remove'])->name('channels.remove');
        Route::get('/channels/{id}/toggle', [ChannelController::class, 'toggleStatus'])->name('channels.toggle');

        Route::resource('/videos', VideoController::class);
        Route::get('/videos/{id}/remove', [VideoController::class, 'remove'])->name('videos.remove');

        Route::resource('/genres', GenreController::class);
        Route::get('/genres/{id}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        Route::patch('/genres/{id}', [GenreController::class, 'update'])->name('genres.update');
    });

});
