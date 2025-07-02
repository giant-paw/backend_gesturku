<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\RiwayatBelajarController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\ProfilController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/files/{path}', [FileController::class, 'show'])->where('path', '.*');

// == RUTE UNTUK PENGGUNA TEROTENTIKASI (UserPembelajar & Admin) ==
// Semua rute di dalam grup ini wajib mengirimkan token yang valid.
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute untuk mendapatkan data profil pengguna yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user()->load('roles:name'); 
    });
    
    // Rute untuk mendapatkan daftar semua kategori
    // Endpoint: GET /api/kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    
    // Rute untuk mendapatkan semua materi di dalam satu kategori spesifik
    // Contoh: GET /api/kategori/1/materi
    Route::get('/kategori/{kategori}/materi', [KategoriController::class, 'showMateri']);
    // (perlu membuat method showMateri di KategoriController)
    
    // Route detail materinya
    Route::get('materi/detail/{materi}', [MateriController::class, 'show']);
    
    // Rute untuk mencatat progres belajar
    // Endpoint: POST /api/riwayat-belajar
    Route::post('/riwayat-belajar', [RiwayatBelajarController::class, 'store']);

    Route::get('/profil/progres', [ProfilController::class, 'ringkasanProgres']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});


// == RUTE KHUSUS ADMIN (CRUD) ==
// Semua rute di dalam grup ini wajib memiliki token DAN peran sebagai 'admin'.
Route::middleware(['auth:sanctum', 'role:admin'])->group(function() {
    Route::post('/materi', [MateriController::class, 'store']); // Create

    // Endpoint untuk memperbarui materi yang ada
    // Contoh: POST /api/materi/5 (catatan: gunakan method POST dengan _method:PUT di Postman)
    Route::put('/materi/{materi}', [MateriController::class, 'update']); // Update

    // Endpoint untuk menghapus materi
    // Contoh: DELETE /api/materi/5
    Route::delete('/materi/{materi}', [MateriController::class, 'destroy']); // Delete
});