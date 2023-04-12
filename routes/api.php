<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PostController::class)->group(function() {
    Route::get('posts', 'index');             //List all Posts
    Route::get('posts/{id}', 'show');          //Show one Post
    Route::post('posts', 'store');             //Create a new Post
    Route::put('posts', 'stote');              //Edit existing Post
    Route::delete('posts/{id}', 'destroy');    //Delete a Post
});
