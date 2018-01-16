<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersStatus extends Model
{
    protected $table    = "orders_status";
    protected $fillable = ["name"];
    public function getOrders(){
        $this->belongsTo('App\Orders');
    }
}
