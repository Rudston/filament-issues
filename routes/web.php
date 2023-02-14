<?php

use Illuminate\Support\Facades\Route;

/* ===========================================================================
1) Special routes
=========================================================================== */

    // redirect root domain to wordpress unless local environment
    Route::get('/', function () {
        if (env('APP_ENV') == 'local') {
            return view('welcome');
        } else {
            return redirect(env('WORDPRESS_URL'));
        }
    });

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

Route::get('/videos/dashboard', App\Http\Livewire\Video\Dashboard::class)->name('videos.dashboard');
Route::get('/videos/view/{video}', App\Http\Livewire\Video\VideoViewer::class)->name('view.video');
Route::get('/videos/edit/{video}', App\Http\Livewire\Video\EditVideo::class)->name('edit.video');
