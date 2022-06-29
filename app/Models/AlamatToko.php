<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatToko extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];

    protected $fillable = [
        'tokoId',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kodepos',
        'provinsiId',
        'kotaId',
        'kecamatanId',
        'phone',
        'email',
        'isActive',
    ];

    protected $casts = [
        'isActive' => 'boolean'
    ];
}
