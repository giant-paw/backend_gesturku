<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MateriController extends Controller
{
    /**
     * Menyimpan materi baru ke dalam database (Create).
     * Hanya bisa diakses oleh Admin.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input yang masuk
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'urutan' => 'required|integer',
            'file' => 'required|file|mimes:mp4,jpg,jpeg,png|max:20480', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Proses dan simpan file yang di-upload
        $path = null;
        if ($request->hasFile('file')) {
            // Ambil tipe file (video atau gambar)
            $mimeType = $request->file('file')->getMimeType();
            $folder = str_starts_with($mimeType, 'video') ? 'videos' : 'images';
            
            // Simpan file ke storage/app/public/videos atau /images
            $path = $request->file('file')->store($folder, 'public');
        }

        // 3. Buat data baru di database
        $materi = Materi::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'urutan' => $request->urutan,
            // Simpan path berdasarkan tipe file
            'url_video' => (isset($folder) && $folder === 'videos') ? $path : null,
            'url_gambar' => (isset($folder) && $folder === 'images') ? $path : null,
        ]);

        // 4. Kembalikan respons sukses
        return response()->json([
            'message' => 'Materi berhasil dibuat',
            'data' => $materi
        ], 201);
    }


    /**
     * Memperbarui data materi yang sudah ada (Update).
     * Hanya bisa diakses oleh Admin.
     */
    public function update(Request $request, Materi $materi)
    {
        // $materi akan otomatis diambil oleh Laravel berdasarkan ID di URL

        // 1. Validasi, 'sometimes' berarti hanya validasi jika field itu dikirim
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|nullable|string',
            'kategori_id' => 'sometimes|required|integer|exists:kategori,id',
            'urutan' => 'sometimes|required|integer',
            'file' => 'sometimes|file|mimes:mp4,jpg,jpeg,png|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Update data dasar
        $materi->update($request->except('file'));

        // 3. Jika ada file baru yang di-upload, ganti file lama
        if ($request->hasFile('file')) {
            // Hapus file lama dari storage
            if ($materi->url_video) Storage::disk('public')->delete($materi->url_video);
            if ($materi->url_gambar) Storage::disk('public')->delete($materi->url_gambar);

            // Tentukan folder dan simpan file baru
            $mimeType = $request->file('file')->getMimeType();
            $folder = str_starts_with($mimeType, 'video') ? 'videos' : 'images';
            $path = $request->file('file')->store($folder, 'public');

            // Update path di database
            $materi->url_video = ($folder === 'videos') ? $path : null;
            $materi->url_gambar = ($folder === 'images') ? $path : null;
            $materi->save();
        }

        // 4. Kembalikan respons sukses
        return response()->json([
            'message' => 'Materi berhasil diperbarui',
            'data' => $materi
        ]);
    }

    /**
     * Menghapus data materi (Delete).
     * Hanya bisa diakses oleh Admin.
     */
    public function destroy(Materi $materi)
    {
        // 1. Hapus file terkait dari storage sebelum menghapus data dari DB
        if ($materi->url_video) {
            Storage::disk('public')->delete($materi->url_video);
        }
        if ($materi->url_gambar) {
            Storage::disk('public')->delete($materi->url_gambar);
        }

        // 2. Hapus data dari database
        $materi->delete();

        // 3. Kembalikan respons sukses tanpa konten
        return response()->json(['message' => 'Materi berhasil dihapus'], 200);
    }
}