<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Stadium extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stadia';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['stadium', 'country_id', 'city', 'nearest_airport', 'image', 'mime', 'filename'];

    public function cities()
    {
        return $this->belongsTo('App\Cities', 'city', 'id');
    }

    public function competition_seating()
    {
        return $this->belongsTo('App\Competition_Seating');
    }

    public function matches()
    {
        return $this->hasMany('App\Match', 'stadium');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function getNearestAirport()
    {
        return $this->belongsTo('App\Airportlist', 'nearest_airport');
    }

    public function getAllAirport()
    {
        return $this->hasMany('App\Airportlist', 'city_id','city');
    }

    public function getAllAirport1()
    {
        return $this->belongsTo('App\Airportlist', 'city_id');
    }

	public function getTranslate()
	{
		return $this->hasMany('App\TransStadia', 'stadia_id' );
	}
}
