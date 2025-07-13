<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\StreamingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files/{path}', [FileController::class, 'show'])->where('path', '.*');

Route::get('/video-stream/{filename}', [StreamingController::class, 'stream'])
    ->where('filename', '.*'); 