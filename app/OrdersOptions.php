<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersOptions extends Model
{
    protected $table = "orders_options";
    protected $fillable = ["orders_id", "options_id", "title", "description", "price", "quantity"];
    public function getOrder() {
        return $this->belongsTo('App\Order');
    }
}
