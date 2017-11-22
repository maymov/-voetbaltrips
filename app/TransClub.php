<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransClub extends Model
{
	protected $table     = "trans_club";

	public $timestamps = false;

	protected $fillable  = ["club_id", "lang_code", "story"];
}
