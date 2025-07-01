<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'kata_sandi' => 'required',
        ]);

        // Mengganti 'password' dengan 'kata_sandi' untuk proses otentikasi
        if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['kata_sandi']])) {
            return response()->json(['message' => 'Email atau Kata Sandi salah'], 401);
        }

        $user = Pengguna::where('email', $credentials['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first()
            ]
        ]);
    }

    public function register(Request $request)
    {
        // 1. Validasi data yang dikirim dari Flutter
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'kata_sandi' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Buat pengguna baru di tabel 'pengguna'
        $user = Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
        ]);

        // 3. Berikan peran default 'userPembelajar' untuk setiap pendaftar baru
        $user->assignRole('userPembelajar');

        // 4. Buat token agar pengguna bisa langsung login setelah registrasi
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Kembalikan respons yang sama seperti saat login
        return response()->json([
            'message' => 'Registrasi berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first()
            ]
        ], 201); // Status 201 artinya "Created"
    }

    public function logout(Request $request)
    {
        // Mengambil pengguna yang terotentikasi berdasarkan token yang dikirim
        $user = $request->user();

        // Menghapus HANYA token yang digunakan untuk request ini.
        // Jika user login di perangkat lain, token di perangkat itu tidak akan terhapus.
        $user->currentAccessToken()->delete();

        // Memberikan respons sukses
        return response()->json([
            'message' => 'Logout berhasil dan token telah dihapus'
        ], 200); // Status 200 OK
    }
}