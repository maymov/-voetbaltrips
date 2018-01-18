<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderMatch extends Model
{
    protected $table    = "orders_match";
    protected $fillable = ["orders_id", "matches_id", "seat_type", "country", "city", "tournament", "stadium", "home_club", "away_club", "match_date", "price", "quantity", "seating_type", 'processed_text', 'actual_price'];
    public function getOrder(){
        $this->belongsTo('App\Order', 'id');
    }
}
