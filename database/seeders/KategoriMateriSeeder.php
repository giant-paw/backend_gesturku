<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Materi;

class KategoriMateriSeeder extends Seeder
{
    public function run(): void
    {
        // === MEMBUAT KATEGORI ===
        $catAlfabet = Kategori::firstOrCreate(
            ['nama' => 'Alfabet'],
            [
                'deskripsi' => 'Pelajari semua huruf alfabet dalam BISINDO dari A sampai Z.',
                'urutan' => 1,
            ]
        );

        $catSapaan = Kategori::firstOrCreate(
            ['nama' => 'Kata Sapaan'],
            [
                'deskripsi' => 'Belajar menyapa teman dan keluargamu menggunakan BISINDO.',
                'urutan' => 2,
            ]
        );

        // === MEMBUAT MATERI ===
        
        // --- Materi untuk Kategori Alfabet ---
        Materi::firstOrCreate(
            ['nama' => 'Huruf A', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'Letakkan ibu jari dan telunjuk membentuk segitiga.',
                'url_video' => 'videos/a_bisindo.mp4', 
                'urutan' => 1
            ]
        );
        
        Materi::firstOrCreate(
            ['nama' => 'Huruf B', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'buat angka 3 dengan jari dan letakkan di telunjuk tegak tangan kiri.',
                'url_video' => 'videos/alfabet/b_bisindo.mp4', 
                'urutan' => 2
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf C', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/c_bisindo.mp4', 
                'urutan' => 3
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf D', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/d_bisindo.mp4', 
                'urutan' => 4
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf E', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/e_bisindo.mp4', 
                'urutan' => 5
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf F', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/f_bisindo.mp4', 
                'urutan' => 6
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf G', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/g_bisindo.mp4', 
                'urutan' => 7
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf H', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/h_bisindo.mp4', 
                'urutan' => 8
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf I', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/i_bisindo.mp4', 
                'urutan' => 9
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf J', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/j_bisindo.mp4', 
                'urutan' => 10
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf K', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/k_bisindo.mp4', 
                'urutan' => 11
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf L', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/L_bisindo.mp4', 
                'urutan' => 12
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf M', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/m_bisindo.mp4', 
                'urutan' => 13
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf N', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/n_bisindo.mp4', 
                'urutan' => 14
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf O', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/o_bisindo.mp4', 
                'urutan' => 15
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf P', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/p_bisindo.mp4', 
                'urutan' => 16
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf Q', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/q_bisindo.mp4', 
                'urutan' => 17
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf R', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/r_bisindo.mp4', 
                'urutan' => 18
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf S', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/s_bisindo.mp4', 
                'urutan' => 19
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf T', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/t_bisindo.mp4', 
                'urutan' => 20
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf U', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/u_bisindo.mp4', 
                'urutan' => 21
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf V', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/v_bisindo.mp4', 
                'urutan' => 22
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf W', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/w_bisindo.mp4', 
                'urutan' => 23
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf X', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/x_bisindo.mp4', 
                'urutan' => 24
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf Y', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/y_bisindo.mp4', 
                'urutan' => 25
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Huruf Z', 'kategori_id' => $catAlfabet->id],
            [
                'deskripsi' => 'nanti diedit.',
                'url_video' => 'videos/alfabet/z_bisindo.mp4', 
                'urutan' => 26
            ]
        );

        // --- Materi untuk Kategori Sapaan ---
        Materi::firstOrCreate(
            ['nama' => 'Assalamualaikum', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk sapaan Assalamualaikum...',
                'url_video' => 'videos/sapaan/assalamualaikum.mp4', 
                'urutan' => 1
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'waalaikumussalam', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk sapaan Waalaikumussalam...',
                'url_video' => 'videos/sapaan/waalaikumussalam.mp4', 
                'urutan' => 2
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Selamat Pagi', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk sapaan Selamat Pagi...',
                'url_video' => 'videos/sapaan/selamat_pagi.mp4', 
                'urutan' => 3
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Selamat Siang', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk sapaan Selamat Pagi...',
                'url_video' => 'videos/sapaan/selamat_siang.mp4', 
                'urutan' => 4
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Selamat Sore', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk sapaan Selamat Pagi...',
                'url_video' => 'videos/sapaan/selamat_sore.mp4', 
                'urutan' => 5
            ]
        );

        Materi::firstOrCreate(
            ['nama' => 'Selamat Malam', 'kategori_id' => $catSapaan->id],
            [
                'deskripsi' => 'Deskripsi gerakan untuk ucapan Terima Kasih...',
                'url_video' => 'videos/selamat_malam.mp4', 
                'urutan' => 6
            ]
        );
    }
}