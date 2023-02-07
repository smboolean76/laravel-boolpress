<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 🕊️ Rotte pubbliche
Route::get('/', function () {
    return view('welcome');
});

// 🚫 Tutte le rotte protette da autenticazione 
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
    Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category:slug']);
    Route::resource('tags', TagController::class)->parameters(['tags' => 'tag:slug']);

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// 🛡️ Tutte le rotte di autenticazione (registrazione, login ecc...)
require __DIR__.'/auth.php';
