<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;

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
}