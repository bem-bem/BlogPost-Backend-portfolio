<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/Blog-post', BlogPostController::class)->middleware('auth');
Route::post('/posts-comment/{id}' , [CommentController::class, 'store'])->middleware('auth')->name('posts.comment');
Route::get('/search', SearchController::class)->middleware('auth')->name('search.index');

Route::resource('users', UserController::class)->only(['show','edit','update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
