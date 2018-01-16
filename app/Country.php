<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table     = "country";
    protected $fillable  = ["code", "name", "flag"];
    
    public function cities() {
        return $this->hasMany('App\Cities');
    }

    public function matches() {
        return $this->belongsTo('App\Match');
    }

    public function stadium() {
    	return $this->belongsTo('App\Stadium');
    }
    public function accomodations(){
        return $this->belongsTo('App\Accomodation');
    }
    public function clubs() {
        return $this->belongsTo('App\Club');
    }
    public function getAirport() {
        return $this->belongsTo('App\Airportlist');
    }
	public function getTranslate() {
		return $this->hasMany('App\TransCountry', 'country_id');
	}
}
