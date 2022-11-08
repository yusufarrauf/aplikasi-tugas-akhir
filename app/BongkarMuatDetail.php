<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BongkarMuatDetail extends Model
{
    protected $fillable = [
        'id_bongkar_muat',
        'id_supir',
        'nomor_kontainer',
        'nomor_segel',
        'form_inspeksi',
        'form_tally',
        'status',
    ];
}
