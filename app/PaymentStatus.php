<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class PaymentStatus extends Model
{
    protected $table    = "payment_status";
    protected $fillable = ["name", "desc"];
    public function getOrder() {
        return $this->belongsTo('App\Order');
    }
}
