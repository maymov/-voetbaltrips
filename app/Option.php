<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'options';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'price'];

}