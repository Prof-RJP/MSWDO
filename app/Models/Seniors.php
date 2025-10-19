<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seniors extends Model
{
    protected $fillable = [
        'brgy_id',
        'osca_id',
        'fname',
        'mname',
        'lname',
        'contact',
        'birthdate',
        'age',
        'gender',
        'status',
    ];

    public function getFullNameAttribute()
    {
        return trim("{$this->lname}, {$this->fname} {$this->mname} ");
    }
    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'brgy_id');
    }

    public function claims() {
        return $this->hasMany(Claims::class);
    }

}
