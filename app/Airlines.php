<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airlines extends Model
{
    protected $table    = "airlines";
    protected $fillable = ["name"];
    public function flight(){
        return $this->belongsTo('App\Flight');
    }
}
