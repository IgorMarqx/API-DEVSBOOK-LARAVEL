<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\content\FeedController;
use App\Http\Controllers\content\PostController;
use App\Http\Controllers\content\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('401');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/refresh', [AuthController::class, 'refresh'])->name('refresh');
Route::post('/user', [AuthController::class, 'create'])->name('user.create');

Route::put('/user', [UserController::class, 'update'])->name('user.update');
Route::post('/user/avatar', [UserController::class, 'updateAvatar'])->name('user.avatar');
Route::post('/user/cover', [UserController::class, 'updateCover'])->name('user.cover');

Route::get('/feed', [FeedController::class, 'read'])->name('feed.read');
Route::get('/user/feed', [FeedController::class, 'userFeed'])->name('feed.userFeed');
Route::get('/user/{id}/feed', [FeedController::class, 'userFeed'])->name('feed.userFeed');

Route::get('/user', [UserController::class, 'read'])->name('user.read');
Route::get('/user/{id}', [UserController::class, 'read'])->name('user.read');

Route::post('/feed', [FeedController::class, 'create'])->name('feed.create');

Route::post('/post/{id}/like', [PostController::class, 'like'])->name('post.like');
Route::post('/post/{id}/comment', [PostController::class, 'comment'])->name('post.comment');

Route::get('/search', [SearchController::class, 'search'])->name('search');
