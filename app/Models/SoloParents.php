<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoloParents extends Model
{
    protected $table = 'solo_parents';

    protected $fillable = [
        'client_id',
        'spouse_name',
        'number_of_children',
        'occupation',
        'monthly_income',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
}
