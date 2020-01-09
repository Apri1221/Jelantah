<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengguna extends Model
{
    //
    protected $fillable = [
        'nama', 'password', 'email', 'perangkat',
    ];
}
