<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Languages extends Model
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'languages';

	public $timestamps = false;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['name', 'code', 'is_main'];

	public function getKeys()
	{
		return $this->belongsToMany('App\LanKeys','languages_keys');
	}

	public function getValues()
	{
		return $this->hasMany('App\LanguagesKeys', 'languages_id', 'id');
	}
}
