<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Import DB Fassad

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = DB::table('riwayat_belajar')
            ->join('pengguna', 'riwayat_belajar.pengguna_id', '=', 'pengguna.id')
            ->select('pengguna.nama', 'pengguna.path_foto_profil', DB::raw('count(riwayat_belajar.materi_id) as total_selesai'))
            ->groupBy('pengguna.id', 'pengguna.nama', 'pengguna.path_foto_profil')
            ->orderBy('total_selesai', 'desc')
            ->limit(10)
            ->get();

        return response()->json($leaderboard);
    }
}