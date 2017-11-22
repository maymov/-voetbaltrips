<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransAccomodation extends Model
{
	protected $table     = "trans_accomodation";
	public $timestamps   = false;
	protected $fillable  = ["accomodation_id", "lang_code", "description"];
}
