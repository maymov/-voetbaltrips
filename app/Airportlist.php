<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Airportlist extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'airportlists';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'city_id', 'title', 'iata_code', 'showinsearch'];
    public function getCountry() {
        return $this->belongsTo('App\Country', 'country_id');
    }
    public function getCity() {
        return $this->belongsTo('App\Cities', 'city_id');
    }
    public function flightFrom(){
        return $this->hasMany('App\Flight', 'from');
    }
    public function flightTo() {
        return $this->hasMany('App\Flight', 'to');
    }
    public function getStadium() {
        return $this->belongsTo('App\Stadium');
    }
}