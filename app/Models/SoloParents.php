<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SoloParents extends Model
{
    protected $table = 'solo_parents';

    protected $fillable = [
        'client_id',
        'id_no',
        'case_no',
        'applied_date',
        'category',
        'benefits',
        'exp_date',
        'solo_status'
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(Childrens::class, 'parent_id', 'id');
    }
    public function getIsExpiredAttribute()
    {
        return Carbon::today()->gt(Carbon::parse($this->exp_date));
    }
    public function getComputedStatusAttribute()
    {
        if ($this->is_expired) {
            return 'expired';
        }

        return $this->solo_status; // new / renew
    }
}
