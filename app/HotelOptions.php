<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelOptions extends Model
{
	protected $table = 'hotel_options';

	public $timestamps = false;
	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	public function getTranslate()
	{
		return $this->hasMany('App\TransOptions', 'option_id');
	}

	public function getAccomodations()
	{
		return $this->belongsToMany('App\Accomodation', 'accomodation_hotel_options', 'option_id');
	}
}
