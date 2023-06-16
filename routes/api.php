<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/posts/show', [PostController::class, 'getUserPosts']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


    Route::middleware(['hasAdminAccess'])->group( function(){

        Route::get('/posts/unpublished', [PostController::class, 'ShowUnpublishedPosts']);
        Route::post('/posts/{id}/accept', [PostController::class, 'accept'])->name('posts.accept');
        Route::post('/posts/{id}/refuse', [PostController::class, 'refuse'])->name('posts.refuse');
        
    });


});