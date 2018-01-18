<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersTicket extends Model
{
    protected $table    = "orders_tickets";
    protected $fillable = ["orders_id", "ticket_type_id", "file_name", 'processed_text', 'actual_price'];
    public function getOrder() {
        return $this->belongsTo('App\Order');
    }
    public function getTicketType() {
        return $this->belongsTo('App\TicketType', 'ticket_type_id');
    }
}
