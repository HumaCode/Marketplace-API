<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // jika email kosong/tidak diisi
        if (!$request->email) {
            return "Email tidak boleh kosong";
        }

        // ambil data user berdasarkan email
        $user = User::where('email', $request->email)->first();



        // jika ada yang cocok maka
        if ($user) {
            return "Selamat datang " . $user->name;
        }

        return "User tidak ditemukan";
    }
}
