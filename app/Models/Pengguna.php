<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; 

class Pengguna extends Authenticatable
{
    use Notifiable, HasRoles; 

    protected $table = 'pengguna'; 

    protected $fillable = [
        'nama', 'email', 'kata_sandi', 'path_foto_profil'
    ];

    protected $hidden = [
        'kata_sandi', 'remember_token',
    ];

    // Ganti nama kolom password bawaan laravel
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}