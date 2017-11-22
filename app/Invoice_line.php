<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_line extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoice_lines';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'product_id', 'product_title', 'product_amount', 'product_vat', 'product_price'];


    public function invoice() {
        return $this->belongsTo('App\Invoice');
    }

}