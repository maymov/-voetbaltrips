<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'status'];

    public function lines() {
        return $this->hasMany('App\Invoice_line');
    }
}