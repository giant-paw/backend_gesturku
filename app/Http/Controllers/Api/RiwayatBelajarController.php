<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RiwayatBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class RiwayatBelajarController extends Controller
{
    /**
     * Menyimpan catatan progres belajar baru.
     * Ini adalah endpoint yang dipanggil setelah Flutter
     * mendapat konfirmasi 'benar' dari server Flask.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        // Memastikan Flutter mengirim 'materi_id' dan nilainya valid.
        $validated = $request->validate([
            'materi_id' => 'required|integer|exists:materi,id'
        ]);

        // 2. Dapatkan Pengguna yang Sedang Login
        // Kita tidak perlu Flutter mengirim siapa usernya, karena kita sudah tahu dari token.
        $pengguna = Auth::user();

        // 3. Simpan Progres (dengan cara yang aman dari duplikat)
        // firstOrCreate akan mencoba mencari baris dengan data ini,
        // jika tidak ada, baru akan dibuat. Ini mencegah duplikasi data.
        $progres = RiwayatBelajar::firstOrCreate(
            [
                'pengguna_id' => $pengguna->id,
                'materi_id' => $validated['materi_id']
            ],
            [
                // Kolom 'diselesaikan_pada' akan otomatis terisi
                // karena kita set default-nya di migrasi.
            ]
        );

        // 4. Berikan Respons yang Sesuai
        if ($progres->wasRecentlyCreated) {
            // Jika record baru dibuat, kirim status 201 (Created)
            return response()->json([
                'message' => 'Progres berhasil disimpan!'
            ], 201);
        } else {
            // Jika record sudah ada, artinya user sudah pernah menyelesaikan ini.
            // Kirim status 200 (OK) saja.
            return response()->json([
                'message' => 'Progres sudah pernah tercatat sebelumnya.'
            ], 200);
        }
    }
}