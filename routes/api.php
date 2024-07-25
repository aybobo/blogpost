<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:api');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('/blog', BlogController::class);
    Route::controller(PostController::class)->group(function () {
        Route::get('/post/{blog_id}', 'index');
        Route::post('/post', 'store');
        Route::get('/post/{id}', 'show');
        Route::put('/post/{id}', 'update');
        Route::delete('/post/{id}', 'delete');
    });
    Route::post('/comment', CommentController::class);
    Route::post('/like', LikeController::class);
});