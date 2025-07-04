<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function ringkasanProgres(Request $request)
    {
        $pengguna = Auth::user();

        $totalSelesai = $pengguna->riwayatBelajar()->count();

        return response()->json([
            'total_selesai' => $totalSelesai
        ]);
    }

    public function update(Request $request)
    {
        $pengguna = Auth::user();

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'foto_profil' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048', // maks 2MB
        ]);

        if ($request->filled('nama')) {
            $pengguna->nama = $request->nama;
        }

        if ($request->hasFile('foto_profil')) {
            if ($pengguna->path_foto_profil) {
                Storage::disk('public')->delete($pengguna->path_foto_profil);
            }
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $pengguna->path_foto_profil = $path;
        }

        $pengguna->save();

        return response()->json([
            'message' => 'Profil berhasil diperbarui',
            'user' => $pengguna->load('roles:name') 
        ]);
    }
}