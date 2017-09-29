<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addres extends Model
{
    protected $fillable = [
        'id','name', 'email', 'phone', 'address'
    ];

    protected $table = 'address';
}
