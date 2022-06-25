<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validasi inputan
        $validasi = Validator::make($request->all(),  [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        // ambil errornya
        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        // ambil data user berdasarkan email
        $user = User::where('email', $request->email)->first();


        // jika ada yang cocok maka
        if ($user) {

            // cek password
            if (password_verify($request->password, $user->password)) {
                return $this->success("Selamat datang " . $user->name, $user);
            } else {
                return $this->error("Password tidak cocok");
            }
        }

        return $this->error("Email tidak ditemukan");
    }

    public function register(Request $request)
    {
        // validasi inputan
        $validasi = Validator::make($request->all(),  [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        // ambil errornya
        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        // masukan data register user ke database
        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));
        if ($user) {
            return $this->success("Akun berhasil dibuat", $user);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if ($user) {

            // update user
            $user->update($request->all());

            return $this->success('Berhasil mengubah data', $user);
        }

        return $this->error("User tidak ditemukan");
    }

    public function success($message = 'success', $data)
    {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function error($message)
    {
        return response()->json([
            'code' => 400,
            'message' => $message,
        ], 400);
    }
}
