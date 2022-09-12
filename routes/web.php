<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/post',[PostController::class,'index']);
Route::post('/post',[PostController::class,'insert']);
Route::get('/post/{id}',[PostController::class,'show']);
Route::put('/post/{id}',[PostController::class,'update']);
Route::delete('/post/{id}',[PostController::class,'destroy']);