<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accomodations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    	                'country_id',
	                    'city',
                        'stars',
                        'high_season_prices',
	                    'low_season_prices',
	                    'breakfast_price',
	                    'name',
	                    'address'
    ];

    public function cityobj()
    {
        return $this->belongsTo('App\Cities', 'city');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', "country_id");
    }

    public function getOptions()
    {
    	return $this->belongsToMany('App\HotelOptions', 'accomodation_hotel_options', 'accomodation_id','option_id');
    }
	public function getTranslate()
	{
		return $this->hasMany('App\TransAccomodation', 'accomodation_id');
	}

    public function images()
    {
        return $this->hasMany('App\AccomodationImages', 'accomodation_id');
    }
}