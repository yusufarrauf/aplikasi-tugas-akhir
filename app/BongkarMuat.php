<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BongkarMuat extends Model
{
    protected $fillable = [
        'id_krani',
        'tujuan',
        'kota',
        'jenis',
        'status',
    ];
}
