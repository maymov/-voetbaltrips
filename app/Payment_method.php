<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_methods';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'default'];

}