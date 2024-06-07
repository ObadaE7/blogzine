<?php

use App\Livewire\Admin\{Dashboard, Profile};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

#.....{Dashboard}.....#
Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth:admin', 'verified'])
    ->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('profile', Profile::class)->name('profile');

        // Route::prefix('post')
        //     ->as('post.')
        //     ->group(function () {
        //         Route::get('index', AllPost::class)->name('index');
        //         Route::get('create', CreatePost::class)->name('create');
        //     });
    });

require __DIR__ . '/admin_auth.php';
