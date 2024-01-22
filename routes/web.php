<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/people', [HomeController::class, 'search'])->name('search');
    Route::get('/suggestions', [HomeController::class, 'suggestions'])->name('suggestions');

    // post
    Route::group(['prefix' => 'post', 'as' => 'post.'], function() {
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');

        Route::post('/store', [PostController::class, 'store'])->name('store');

        Route::patch('/update/{id}', [PostController::class, 'update'])->name('update');

        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('destroy');
    });

    // comment
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function() {
        Route::post('/store/{id}', [CommentController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });

    // profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function() {
        Route::get('/show/{id}', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::get('/{user_id}/followers', [ProfileController::class, 'followers'])->name('followers');
        Route::get('/{user_id}/following', [ProfileController::class, 'following'])->name('following');

        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
    });

    // Like
    Route::group(['prefix' => 'like', 'as' => 'like.'], function() {
        Route::post('/{post_id}/store', [LikeController::class, 'store'])->name('store');
        Route::delete('/{post_id}/destroy', [LikeController::class, 'destroy'])->name('destroy');
    });

    // Follow
    Route::group(['prefix' => 'follow', 'as' => 'follow.'], function() {
        Route::post('/{user_id}/store', [FollowController::class, 'store'])->name('store');
        Route::delete('/{user_id}/delete', [FollowController::class, 'destroy'])->name('destroy');
    });

    // Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function() {
        // User
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');
        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');

        // posts
        Route::get('/posts', [PostsController::class, 'index'])->name('posts');
        Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide');
        Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide');

        // category
        Route::get('/category', [CategoriesController::class, 'index'])->name('category');
        Route::post('/category/store', [CategoriesController::class, 'store'])->name('category.store');
        Route::patch('/category/{id}/update', [CategoriesController::class, 'update'])->name('category.update');
        Route::delete('/category/{id}/delete', [CategoriesController::class, 'destroy'])->name('category.destroy');
    });
});