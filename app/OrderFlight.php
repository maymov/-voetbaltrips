<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderFlight extends Model
{
    protected $table = "orders_flight";
    protected $fillable = ["orders_id", "flightmode", "airlines_id", "airlines_name", "flight_number", "departure_airport", "arrival_airport", "via", "departure_date", "departure_time", "arrive_date", "arrive_time", "duration", "price", "quantity", 'processed_text', 'actual_price'];
    public function getOrderDetails(){
        return $this->belongsTo('App\Order');
    }
}
