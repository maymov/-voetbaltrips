<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransCity extends Model
{
	protected $table     = "trans_city";

	public $timestamps = false;

	protected $fillable  = ["city_id", "lang_code", "trans_name"];

	public function city(){
        return $this->belongsTo('App\City', 'city_id');
    }
}

