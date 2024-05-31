<?php

use App\Livewire\{AllPost, Home, Dashboard, CreatePost, Post, Posts, Profile, Tag};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

#.....{Home}.....#
Route::get('/', Home::class)->name('home');
Route::get('post/{slug}', Post::class)->name('post');
Route::get('posts', Posts::class)->name('posts');
Route::get('tags/{slug}', Tag::class)->name('tags');


#.....{Dashboard}.....#
Route::prefix('dashboard')
    ->as('dashboard.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('profile', Profile::class)->name('profile');

        Route::prefix('post')
            ->as('post.')
            ->group(function () {
                Route::get('index', AllPost::class)->name('index');
                Route::get('create', CreatePost::class)->name('create');
            });
    });

require __DIR__ . '/auth.php';
