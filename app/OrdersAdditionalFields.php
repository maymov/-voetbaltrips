<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersAdditionalFields extends Model
{
    protected $table    = "orders_additional_data";
    protected $fillable = ["orders_id", "first_name", "last_name", "gender", "passport_number"];
}
