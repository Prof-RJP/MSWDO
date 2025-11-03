<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Childrens extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'birthdate',
        'status'
    ];
}
