<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aics extends Model
{
    protected $fillable=[
        'client_id',
        'principal_client',
        'diagnosis',
        'gis'
    ];

    public function client()
{
    return $this->belongsTo(Clients::class);
}

}
