<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransStadia extends Model
{
	protected $table    = "trans_stadia";
	public $timestamps  = false;
	protected $fillable = ["stadia_id", "lang_code", "story"];

}
