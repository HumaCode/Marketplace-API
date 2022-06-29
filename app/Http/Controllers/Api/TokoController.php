<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi inputan
        $validasi = Validator::make($request->all(),  [
            'userId'    => 'required',
            'name'      => 'required',
            'kota'      => 'required',
        ]);

        // ambil errornya
        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        // masukan ke tabel
        $toko = Toko::create($request->all());

        return $this->success('Toko berhasil dibuat', $toko);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cekToko($id)
    {
        // cek user berdasarkan id
        $user = User::where('id', $id)->with('toko')->first();

        // jika ada
        if ($user) {
            return $this->success('Success', $user);
        } else {
            return $this->error('User tidak ditemukan!');
        }
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
