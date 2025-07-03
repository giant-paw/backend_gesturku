<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files/{path}', [FileController::class, 'show'])->where('path', '.*');