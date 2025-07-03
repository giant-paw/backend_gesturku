<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('urutan', 'asc')->get();
        return response()->json($kategori);
    }

    public function showMateri(Kategori $kategori) {

        // Route Model Binding ( /kategori/{kategori}/materi)
        $semuaMateri = $kategori->materi()->orderBy('urutan', 'asc')->get();

        $pengguna = Auth::user();

        $materiSelesaiIds = $pengguna->riwayatBelajar()
                                    ->pluck('materi_id');

        $materiDenganProgres = $semuaMateri->map(function ($materi) use ($materiSelesaiIds) {
            $materi->is_completed = $materiSelesaiIds->contains($materi->id);
            return $materi;
        });

        return response()->json($materiDenganProgres);
    }
}
