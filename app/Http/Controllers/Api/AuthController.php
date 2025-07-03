<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;


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
                'role' => $user->getRoleNames()->first(),
                'path_foto_profil' => $user->path_foto_profi
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'kata_sandi' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dataToCreate = [
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
        ];

        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            $dataToCreate['path_foto_profil'] = $path;
        }

        $user = Pengguna::create($dataToCreate);

        // default 'userPembelajar'
        $user->assignRole('userPembelajar');

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'nama' => $user->nama,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
                'path_foto_profil' => $user->path_foto_profi
            ]
        ], 201);
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