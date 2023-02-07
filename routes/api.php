<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('test', function() {
//     return [
//         'name' => "Samuele",
//         "surname" => "Madrigali"
//     ];
// });

// /api/posts
Route::get('posts', [PostController::class, 'index']);
// /api/posts/sit-ut-facilis-atque-earum
Route::get('posts/{slug}', [PostController::class, 'show']);
// /api/comments/{post_id}
Route::post('comments/{post}', [CommentController::class, 'store']);
// /api/categories
Route::get('categories', [CategoryController::class, 'index']);
// /api/categories/{slug}
Route::get('categories/{slug}', [CategoryController::class, 'show']);

// /api/contact-fom
Route::post('contact-form', [ContactFormController::class, 'email']);