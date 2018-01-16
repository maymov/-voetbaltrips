<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plans';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'price', 'months', 'active'];

}