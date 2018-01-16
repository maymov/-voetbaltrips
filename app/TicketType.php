<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $table = "tickets_type";
    protected $fillable = ["name"];
    public function getOrderTickert() {
        return $this->belongsTo('App\OrdersTicket');
    }

}
