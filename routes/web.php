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
Route::get('/login', [UserLoginController::class, 'showLogin']);
Route::post('/login', [UserLoginController::class, 'login'])->name('/login');
Route::get('/logout', [UserLoginController::class, 'logout']);

use App\Http\Controllers\User\UserProfileController;
Route::get('/user', [UserProfileController::class, 'showProfile'])->middleware('auth');
Route::get('/user/edit', [UserProfileController::class, 'showEdit'])->middleware('auth');
Route::put('/user/edit/submit', [UserProfileController::class, 'submit'])->middleware('auth');



use App\Http\Controllers\Blog\BlogListController;
//user and the following 
Route::get('/blog', [BlogListController::class, 'showBlogList']);
Route::get('/blog/lobby', [BlogListController::class, 'showLobby']);

Route::get('/blog/likes', [BlogListController::class, 'showLikes'])->middleware('auth');
Route::get('/blog/search', [BlogListController::class, 'showSearch']);
Route::get('/blog/user', [BlogListController::class, 'showUserPost'])->middleware('auth');

//user post page with profile
Route::get('/{authorName}',[BlogListController::class, 'showUserPost']);


use App\Http\Controllers\User\UserFollowController;
//follow user
Route::post('/{authorName}/follow',[UserFollowController::class, 'follow'])->middleware('auth');
Route::post('/{authorName}/unfollow',[UserFollowController::class, 'unfollow'])->middleware('auth');

use App\Http\Controllers\Blog\BlogPostController;
Route::get('/blog/article/{postId}', [BlogPostController::class, 'showBlogPost']);
Route::get('/blog/article/commentload/{parentId}/{lastId}', [BlogPostController::class, 'loadComment']);
Route::get('/blog/article/imageslider/{postId}', [BlogPostController::class, 'loadImageSlider']);


use App\Http\Controllers\Blog\BlogEditController;
Route::get('/blog/edit/{postId}', [BlogEditController::class, 'showBlogEdit'])->middleware('auth');  

Route::put('/blog/edit/{postId}/submit', [BlogEditController::class, 'submit'])->middleware('auth'); 
 Route::post('/blog/edit/{postId}/delete', [BlogEditController::class, 'delete'])->middleware('auth'); 



use App\Http\Controllers\Blog\BlogCommentController;
Route::put('/blog/article/{postId}/comment/{commentId?}', [BlogCommentController::class, 'create'])->middleware('auth');

use App\Http\Controllers\Blog\BlogUserLikePostController;
Route::post('/blog/article/{postId}/like', [BlogUserLikePostController::class, 'likePost'])->middleware('auth');
Route::post('/blog/article/{postId}/cancel-like', [BlogUserLikePostController::class, 'cancelLikePost'])->middleware('auth');


