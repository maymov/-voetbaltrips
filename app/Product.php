<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code', 'category', 'price'];

}