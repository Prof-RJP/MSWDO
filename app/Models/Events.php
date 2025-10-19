<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Events extends Model {
    protected $fillable = ['title','starts_at','ends_at','status'];

    public function claims() {
        return $this->hasMany(Claims::class);
    }
    public function celebrants()
{
    // Get the month of the event start date
    $month = date('m', strtotime($this->starts_at));

    // Return all seniors whose birth month matches
    return Seniors::whereMonth('birthdate', $month)->get();
}
}
