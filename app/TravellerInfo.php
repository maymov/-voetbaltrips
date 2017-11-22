<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravellerInfo extends Model
{
    protected $table = "traveller_information";
    protected $fillable = [
                "order_id",
                "name",
                "first_name",
                "last_name",
                "country_text",
                "city_text",
                "address",
                "postcode",
                "phone_number",
                "email",
                "date_of_birth",
                "gender",
                "nationality",
                "city",
                "identity_type",
                "passport_number",
                "passport_validity",
                "passport_document",
                "is_updated"
    ];
    public function getOrder() {
        return $this->belongsTo('App\Order', 'id');
    }

}
