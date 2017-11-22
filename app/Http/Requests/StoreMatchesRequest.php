<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreMatchesRequest extends Request
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
        return ['tournament' => "required",
                'stadium'    => "required",
                'home_club'  => "required",
                'away_club'  => "required",
                'match_date' => "required"
        ];

    }
}
