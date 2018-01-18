<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'description'];

}