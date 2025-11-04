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
    public function parent()
    {
        return $this->belongsTo(SoloParents::class, 'parent_id');
    }

}
