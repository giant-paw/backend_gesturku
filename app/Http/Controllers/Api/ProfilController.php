<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}