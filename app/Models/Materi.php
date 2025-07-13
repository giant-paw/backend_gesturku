<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Kategori;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';

    protected $fillable = [
        'nama',
        'deskripsi',
        'kategori_id',
        'urutan',
        'url_video',
        'url_gambar',
    ];

    /**
     * Mendefinisikan relasi bahwa satu Materi dimiliki oleh satu Kategori.
     */
    public function kategori()
    {
        // 'kategori_id' adalah foreign key di tabel 'materi'
        // 'id' adalah primary key di tabel 'kategori'
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
