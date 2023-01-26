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



// Route::get('/', 'App\Http\Controllers\HomeController@showIndex')->name('show-home');


use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'showIndex'])->name('show-home');


use App\Http\Controllers\UserRegisterController;
Route::post('/register', [UserRegisterController::class, 'register'])->name('user-register');

Route::post('/login', [UserRegisterController::class, 'login'])->name('user-login');

Route::get('/logout', [UserRegisterController::class, 'logout'])->name('user-logout');   


use App\Http\Controllers\Blog\BlogListController;
Route::get('/blog', [BlogListController::class, 'showBlogList'])->name('blog-list');  


use App\Http\Controllers\Blog\BlogPostController;
Route::get('/blog/article/{postId}', [BlogPostController::class, 'showBlogPost'])->name('blog-post');  


use App\Http\Controllers\Blog\BlogEditController;
Route::get('/blog/edit/{postId}', [BlogEditController::class, 'showBlogEdit'])->name('blog-edit');  
Route::put('/blog/edit/{postId}/submit', [BlogEditController::class, 'submit']); 
// Route::post('/blog/edit/{postId}/submit', [BlogEditController::class, 'submitpost']);  



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
