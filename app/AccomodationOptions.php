<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccomodationOptions extends Model
{
	protected $table = 'accomodation_hotel_options';

	public $timestamps = false;
	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['accomodation_id', 'option_id'];
}
