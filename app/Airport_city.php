<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport_city extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'airport_cities';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['airport_id', 'city_id'];

}