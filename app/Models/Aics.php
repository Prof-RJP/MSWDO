<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aics extends Model
{
    protected $fillable=[
        'client_id',
        'principal_client',
        'civil_status',
        'occupation',
        'educational_attainment',
        'gis'
    ];

    public function client()
{
    return $this->belongsTo(Clients::class);
}

}
