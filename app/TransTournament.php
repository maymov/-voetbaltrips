<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransTournament extends Model
{
	protected $table     = "trans_tournaments";
	public $timestamps   = false;
	protected $fillable  = ["tournament_id", "lang_code", "story"];
}

