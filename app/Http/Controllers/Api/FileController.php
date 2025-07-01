<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($path)
    {
        // Mengambil path lengkap ke file di dalam folder storage
        $fullPath = Storage::disk('public')->path($path);

        // Periksa apakah file benar-benar ada
        if (!File::exists($fullPath)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Ambil konten file
        $file = File::get($fullPath);
        // Ambil tipe MIME dari file (misal: 'image/png' atau 'video/mp4')
        $type = File::mimeType($fullPath);

        // Buat respons untuk mengirim file ini
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}