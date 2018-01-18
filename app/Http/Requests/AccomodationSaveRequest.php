<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AccomodationSaveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "city"                => "required",
            "stars"               => "required",
            "high_season_prices"  => "required",
            "low_season_prices"   => "required",
            "options"             => "required",
            "breakfast_price"     => "required",
            "images"              => "required|mimes:png,jpg,jpeg,JPG,JPEG,PNG,gif,GIF",
            "description"         => "required"
        ];
    }
}
