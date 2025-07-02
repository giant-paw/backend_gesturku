<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatBelajar extends Model
{
    protected $table = 'riwayat_belajar';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pengguna_id',
        'materi_id',
    ];
}
