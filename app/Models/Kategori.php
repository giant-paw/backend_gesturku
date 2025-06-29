<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    /**
     * Mendefinisikan relasi bahwa satu Kategori memiliki banyak Materi.
     */
    public function materi()
    {
        return $this->hasMany(Materi::class, 'kategori_id');
    }
}
