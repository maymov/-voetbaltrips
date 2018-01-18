<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LanKeys extends Model
{
	protected $table = 'lankeys';

	public $timestamps = false;

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */

	protected $fillable = ['name'];

	public function getLanguages()
	{
		return $this->belongsToMany('App\Languages','languages_keys');
	}

	public function getValues()
	{
		return parent::hasMany('App\LanguagesKeys', 'lan_keys_id', 'id');
	}
}
