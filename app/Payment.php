<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'received_on', 'payment_method_id', 'amount', 'notes'];

}