<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransOptions extends Model
{
	protected $table = 'trans_options';

	public $timestamps = false;
	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['lang_code', 'option_id', 'trans_name'];
}
