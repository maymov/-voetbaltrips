<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCart extends Model
{
    protected $table    = "users_cart";
    protected $fillable = ["users_id", "name", "quantity", "price", "type", "identifier", "match_id"];
}

