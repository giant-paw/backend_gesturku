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
        $materi = $kategori->materi()->orderBy('urutan', 'asc')->get();

        return response()->json($materi);
    }
}
