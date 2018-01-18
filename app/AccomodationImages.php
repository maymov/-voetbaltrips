<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AccomodationImages extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accomodation_images';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    	                'accomodation_id',
	                    'image'
    ];

    public function accomodation()
    {
        return $this->belongsTo('App\Accomodation', 'accomodation_id');
    }

}