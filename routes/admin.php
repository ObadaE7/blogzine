<?php

use App\Livewire\Admin\{CategoryTable, Dashboard, PostTable, Profile, Settings, TagTable, UserTable};
use App\Livewire\Admin\Tables\ShowUser;
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
        Route::get('settings', Settings::class)->name('settings');

        Route::prefix('table')
            ->as('table.')
            ->group(function () {
                Route::get('users', UserTable::class)->name('users');
                Route::get('users/{id}/show', ShowUser::class)->name('users.show');
                Route::get('categories', CategoryTable::class)->name('categories');
                Route::get('tags', TagTable::class)->name('tags');
                Route::get('posts', PostTable::class)->name('posts');
            });
    });

require __DIR__ . '/admin_auth.php';
