<?php

use App\Livewire\{AllPost, Home, Dashboard, CreatePost};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

#.....{Home}.....#
Route::get('/', Home::class)->name('home');

#.....{Dashboard}.....#
Route::prefix('dashboard')
    ->as('dashboard.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');

        Route::prefix('post')
            ->as('post.')
            ->group(function () {
                Route::get('index', AllPost::class)->name('index');
                Route::get('create', CreatePost::class)->name('create');
            });
    });

require __DIR__ . '/auth.php';
