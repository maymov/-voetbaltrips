<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table    = "orders";
    protected $fillable = [
    	    "users_id",
	        "first_name",
	        "last_name",
	        "gender",
	        "country",
	        "state",
	        "city",
	        "address",
	        "postal",
	        "payment_method",
	        "payment_status",
	        "order_status",
	        "order_total",
            "sent_tickets_home"
    ];

    public function getMatchesOrder() {
        return $this->hasOne('App\OrderMatch', 'orders_id');
    }
    public function getOrderStatus() {
        return $this->hasOne('App\OrdersStatus','id', 'order_status');
    }
    public function getOrderFlightDetails() {
        return $this->hasMany('App\OrderFlight', 'orders_id');
    }
    public function getTravellerInformation() {
        return $this->hasMany('App\TravellerInfo', 'order_id', 'id');
    }
    public function getHotelDetails() {
        return $this->hasOne('App\OrderAccomodation', 'orders_id');
    }
    public function getPaymentStatus() {
        return $this->belongsTo('App\PaymentStatus', 'payment_status');
    }
    public function getAdminUploadedTickets() {
        return $this->hasMany('App\OrdersTicket', 'orders_id');
    }
    public function getOrderOptions() {
        return $this->hasMany('App\OrdersOptions', 'orders_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'users_id');
    }
}
