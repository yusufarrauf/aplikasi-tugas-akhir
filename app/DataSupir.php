<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSupir extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'handphone',
        'tanggal_lahir',
        'nopol_kendaraan',
    ];
}
