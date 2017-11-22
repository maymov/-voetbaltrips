<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StadiumSaveRequest extends Request
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
            "stadium"       => "required",
            "country_id"    => "required",
            "city"          => "required",
            "airport"       => "required",
            "image"         => 'required|mimes:png,jpg,jpeg,gif,bmp,svg,JPG,JPEG,PNG,GIF,BMP,SVG|max:2048',
        ];
    }
}
