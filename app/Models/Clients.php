<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'address',
        'contact',
        'gender',
    ];
}
