<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeatingCategory extends Model
{
    protected $table    = "seatingcategory";

    protected $fillable = ["name", "color"];

    public function getCompetitionSeating()
    {
        return $this->belongsTo('App\Competition_seating');
    }
}
