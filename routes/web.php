<?php

use App\Livewire\{Home, Dashboard, CreatePost};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Home::class)->name('home');
Route::prefix('dashboard')
    ->as('dashboard.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/create-post', CreatePost::class)->name('create.post');
    });
require __DIR__ . '/auth.php';
