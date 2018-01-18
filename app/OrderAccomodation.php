<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAccomodation extends Model
{
    protected $table    = "orders_accomodation";
    protected $fillable = ["orders_id", "orders_match_id", "hotel_name", "star", "address", "city", "country", "price", "quantity", "include_breakfast", "breakfast_price", "rooms_days", 'actual_price'];
    public function getOrder() {
        return $this->belongsTo('App\Order');
    }
}
