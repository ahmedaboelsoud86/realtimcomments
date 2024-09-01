<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::post('/tokens/create', [CommentController::class, 'createToken']);





Route::get('posts/{post}/comments', [CommentController::class, 'index']);



//Route::post('posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
