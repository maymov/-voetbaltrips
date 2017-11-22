<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransCountry extends Model
{
	protected $table     = "trans_country";

	public $timestamps = false;

	protected $fillable  = ["country_id", "lang_code", "trans_name"];

}

