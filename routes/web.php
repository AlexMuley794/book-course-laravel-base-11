<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\PostController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('post', PostController::class);
