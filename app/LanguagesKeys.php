<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class LanguagesKeys extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'languages_keys';

	public $timestamps = false;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */

	protected $fillable = 	['languages_id', 'lan_keys_id', 'value'];

}
