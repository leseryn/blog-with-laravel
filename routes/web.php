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
Route::get('/', [HomeController::class, 'showIndex'])->name('/');


use App\Http\Controllers\User\UserRegisterController;
Route::post('/register', [UserRegisterController::class, 'register'])->name('user-register');

use App\Http\Controllers\User\UserLoginController;
Route::post('/login', [UserLoginController::class, 'login']);
Route::get('/logout', [UserLoginController::class, 'logout']);

use App\Http\Controllers\User\UserProfileController;
Route::get('/user', [UserProfileController::class, 'showProfile'])->middleware('auth');
Route::get('/user/edit', [UserProfileController::class, 'showEdit'])->middleware('auth');

use App\Http\Controllers\Blog\BlogListController;
Route::get('/blog', [BlogListController::class, 'showBlogList']);
Route::get('/blog/likes', [BlogListController::class, 'showLikes'])->middleware('auth');
Route::get('/blog/search', [BlogListController::class, 'showSearch']);
Route::get('/blog/user', [BlogListController::class, 'showUserPost'])->middleware('auth');



use App\Http\Controllers\Blog\BlogPostController;
Route::get('/blog/article/{postId}', [BlogPostController::class, 'showBlogPost']);



use App\Http\Controllers\Blog\BlogEditController;
Route::get('/blog/edit/{postId}', [BlogEditController::class, 'showBlogEdit'])->middleware('auth');  

Route::put('/blog/edit/{postId}/submit', [BlogEditController::class, 'submit'])->middleware('auth');  



use App\Http\Controllers\Blog\BlogCommentController;
Route::put('/blog/article/{postId}/comment/{commentId?}', [BlogCommentController::class, 'create'])->middleware('auth');

use App\Http\Controllers\Blog\BlogUserLikePostController;
Route::post('/blog/article/{postId}/like', [BlogUserLikePostController::class, 'likePost'])->middleware('auth');
Route::post('/blog/article/{postId}/cancel-like', [BlogUserLikePostController::class, 'cancelLikePost'])->middleware('auth');


