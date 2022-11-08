<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKrani extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'handphone',
        'region',
    ];
}
