<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna; 
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = Pengguna::firstOrCreate(
            ['email' => 'admin@gesturku.com'],
            [
                'nama' => 'Admin Gesturku',
                'kata_sandi' => Hash::make('12345678'), 
            ]
        );
        // Memberikan peran 'admin' kepada pengguna yang baru dibuat
        $admin->assignRole('admin');


        $pembelajar = Pengguna::firstOrCreate(
            ['email' => 'giant@user.com'],
            [
                'nama' => 'Giant',
                'kata_sandi' => Hash::make('12345678'), 
            ]
        );
        // Memberikan peran 'userPembelajar' kepada pengguna yang baru dibuat
        $pembelajar->assignRole('userPembelajar');
    }
}