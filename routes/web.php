<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () 
{
    return view('welcome');
});

Route::get('/posts', [PostController::class,'index']);
ROute::get('/posts/create',[PostController::class,'create']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::get('/posts/{post}/edit',[PostController::class,'edit']);
Route::put('posts/{post}',[PostController::class,'update']);