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
        'brgy_id',
        'birthdate',
        'contact',
        'gender',
    ];

    // ✅ Relationship with Barangay
    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'brgy_id');
    }

    // ✅ Relationship with Solo Parent
    public function soloParent()
    {
        return $this->hasOne(SoloParents::class, 'client_id');
    }

    // ✅ Full name accessor
    public function getFullNameAttribute()
    {
        $middle = $this->mname ? ' ' . $this->mname : '';
        return trim("{$this->lname}, {$this->fname}{$middle}");
    }

}
