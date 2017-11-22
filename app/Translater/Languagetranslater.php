<?php

namespace App\Translater;

use App\Languages;
use App\LanguagesKeys;
use App\LanKeys;
use Illuminate\Support\Facades\Session;

class Languagetranslater
{
	public static function getValue($key)
	{
		if (!Session::has('lang_id')) {
			$lang   = Languages::where('code', Session::get('lang_code'))->first();
			Session::put('lang_id', $lang->id);
		}
		$id = Session::get('lang_id');

		$value  = LanKeys::where('name', $key)->with(['getValues' => function($q) use ($id){
			$q->where('languages_id', $id);
		}])->first();

		if ($value && !empty($value->getValues)) {
			return $value->getValues[0]->value;
		} else {
			return '!!!';
		}
	}

	public static function getLanguage()
	{
		if (!Session::has('lang_code')) {
			$code = Languages::where('is_main', 1)->select('code', 'id')->first();

			Session::put('lang_code', strtoupper($code->code));
			Session::put('lang_id', strtoupper($code->id));
		}
	}
}