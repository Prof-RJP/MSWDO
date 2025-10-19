<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claims extends Model
{
    protected $fillable = [
        'event_id',
        'senior_id',
        'claimed_at',
        'remark',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Events::class);
    }

    public function senior()
    {
        return $this->belongsTo(Seniors::class);
    }
}
