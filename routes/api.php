<?php

use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\LikeCommentController;
use App\Http\Controllers\api\LikePostController;
use App\Http\Controllers\api\PostController;
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

Route::group([
    'prefix' => 'v1'
], function () {
    Route::delete('likes/{like}', [LikeController::class, 'destroy']);

    Route::post('posts/{post}/likes', [LikePostController::class, 'store']);
    Route::post('comments/{comment}/likes', [LikeCommentController::class, 'store']);

    Route::get('posts/{post}/comments', [CommentController::class, 'index']);
    Route::get('comments/{comment}', [CommentController::class, 'show']);
    Route::post('posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

    Route::apiResource('posts', PostController::class);
});
