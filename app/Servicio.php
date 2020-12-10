<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $fillable = [
        'name', 'description', 'database', 'dbpass'
    ];

    protected $hidden = [
        'database', 'dbpass'
    ];
}
