<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'civil_status',
        'occupation',
        'educational_attainment',
        'address',
        'birthdate',
        'contact',
        'gender',
    ];

    public function getFullNameAttribute()
    {
        return trim("{$this->fname} {$this->mname} {$this->lname}");
    }
}
