<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlamatToko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlamatTokoController extends Controller
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
            'alamat'     => 'required',
            'provinsi'   => 'required',
            'kota'       => 'required',
            'kodepos'    => 'required',
            'email'      => 'required',
            'phone'      => 'required',
        ]);

        // ambil errornya
        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        // masukan ke tabel
        $toko = AlamatToko::create($request->all());

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
        $alamat = AlamatToko::where('tokoId', $id)->where('isActive', true)->get();

        return $this->success('success', $alamat);
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
        $alamat = AlamatToko::where('id', $id)->first();

        if ($alamat) {
            // masukan ke tabel
            $alamat->update($request->all());

            return $this->success('success', $alamat);
        } else {
            return $this->error('Alamat tidak ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alamat = AlamatToko::where('id', $id)->first();

        if ($alamat) {
            $alamat->update([
                'isActive' => false
            ]);

            return $this->success('berhasil dihapus', $alamat);
        } else {
            return $this->error('Alamat tidak ditemukan');
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
