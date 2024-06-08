<?php

use App\Livewire\Admin\{CategoryTable, Dashboard, PostTable, Profile, TagTable, UserTable};
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

        Route::prefix('table')
            ->as('table.')
            ->group(function () {
                Route::get('users', UserTable::class)->name('users');
                Route::get('categories', CategoryTable::class)->name('categories');
                Route::get('tags', TagTable::class)->name('tags');
                Route::get('posts', PostTable::class)->name('posts');
            });
    });

require __DIR__ . '/admin_auth.php';
