<?php

use App\Events\testEvent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostWebController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    event(new testEvent);
    return view('welcome');
});



Route::post('posts/{post}/comment', [CommentController::class, 'store'])->middleware('auth:sanctum');



Route::any('getNotification', [NotificationController::class, 'index']);

Route::any('readNotification', [NotificationController::class, 'markasread']);

Route::any('readNotification/{id}', [NotificationController::class, 'readnot']);


Route::get('posts', [PostWebController::class, 'index']);

Route::get('post/{post}', [PostWebController::class, 'show'])->name('show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
