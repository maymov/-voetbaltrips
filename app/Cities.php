<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Cities extends Model
{
    protected $table = 'cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country_id'];
    /**
     * FInding the country name
     */
    public function country(){
        return $this->belongsTo('App\Country', 'country_id');
    }
    public function accomodation(){
        return $this->hasMany('App\Accomodation', 'city');
    }
    public function stadium(){
        return $this->hasMany('App\Stadium');
    }
    public function matches(){
        return $this->belongsTo('App\Match');
    }
    public function clubs() {
        return $this->hasMany('App\Club', 'city');
    }

    public function getAirports() {
        $this->belongsTo('App\Airportlist');
    }
	public function getTranslate() {
		return $this->hasMany('App\TransCity', 'city_id' );
	}

    public function scopeDropdown($query)
    {
        $query->join('country','city.country_id', '=', 'country.id')->get();
    }
}
