<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda akan mendaftarkan semua rute API untuk aplikasi Anda.
| Rute-rute ini akan secara otomatis memiliki prefix /api.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
