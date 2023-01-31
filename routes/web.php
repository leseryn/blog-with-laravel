<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/playground', function () {
    event(new \App\Events\PlaygroundEvent());
    return null;
});

// Route::get('/likepost', function () {
//     event(new \App\Events\LikePostEvent(1));
//     return null;
// });

// Route::get('/', 'App\Http\Controllers\HomeController@showIndex')->name('show-home');


use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'showIndex'])->name('show-home');


use App\Http\Controllers\User\UserRegisterController;
Route::post('/register', [UserRegisterController::class, 'register'])->name('user-register');
use App\Http\Controllers\User\UserLoginController;

Route::post('/login', [UserLoginController::class, 'login']);

Route::get('/logout', [UserLoginController::class, 'logout']);


use App\Http\Controllers\Blog\BlogListController;
Route::get('/blog', [BlogListController::class, 'showBlogList'])->name('blog-list');  


use App\Http\Controllers\Blog\BlogPostController;
Route::get('/blog/article/{postId}', [BlogPostController::class, 'showBlogPost'])->name('blog-post');  


use App\Http\Controllers\Blog\BlogEditController;
Route::get('/blog/edit/{postId}', [BlogEditController::class, 'showBlogEdit'])->name('blog-edit');  
Route::put('/blog/edit/{postId}/submit', [BlogEditController::class, 'submit']);


use App\Http\Controllers\Blog\BlogCommentController;
Route::put('/blog/article/{postId}/comment/{commentId?}', [BlogCommentController::class, 'create']);

use App\Http\Controllers\Blog\BlogUserLikePostController;
Route::post('/blog/article/{postId}/like', [BlogUserLikePostController::class, 'likePost']);
Route::post('/blog/article/{postId}/cancel-like', [BlogUserLikePostController::class, 'cancelLikePost']);


