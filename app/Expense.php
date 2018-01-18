<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'date', 'category', 'amount'];

}