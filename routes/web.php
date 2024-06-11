<?php

use App\Livewire\Admin\{CategoryTable, Dashboard as AdminDashboard, PostTable, Profile as AdminProfile, Settings, TagTable, UserTable};
use App\Livewire\Admin\Tables\ShowUser;

use App\Livewire\{AllPost, Categories, Category, Home, Dashboard, CreatePost, Post, Posts, Profile, Tag};
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
Route::get('category/{slug}', Category::class)->name('category');
Route::get('categories', Categories::class)->name('categories');

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

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        require __DIR__ . '/auth.php';
    });
