<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::orderBy('urutan', 'asc')->get();
        return response()->json($kategori);
    }

    public function showMateri(Kategori $kategori)
    {
        $pengguna = Auth::user();

        if (!$pengguna) {
            $semuaMateri = $kategori->materi()->orderBy('urutan', 'asc')->get();
            $materiDenganStatus = $semuaMateri->map(function ($materi, $index) {
                $materi->is_completed = false;
                $materi->is_unlocked = ($index == 0);
                return $materi;
            });
            return response()->json($materiDenganStatus);
        }

        $semuaMateri = $kategori->materi()->orderBy('urutan', 'asc')->get();
        $materiSelesaiIds = $pengguna->riwayatBelajar()->pluck('materi_id');

        $materiSelanjutnya = $semuaMateri->firstWhere(function ($materi) use ($materiSelesaiIds) {
            return !$materiSelesaiIds->contains($materi->id);
        });

        $materiDenganProgres = $semuaMateri->map(function ($materi) use ($materiSelesaiIds, $materiSelanjutnya) {
            $materi->is_completed = $materiSelesaiIds->contains($materi->id);
            
            $materi->is_unlocked = $materi->is_completed || ($materiSelanjutnya && $materi->id == $materiSelanjutnya->id);
            
            return $materi;
        });

        return response()->json($materiDenganProgres);
    }
}
