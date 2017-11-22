<?php

use App\Setting;

function addAdditionalPrice($price = null)
{
    if (empty($price)) return $price;

    if (!Session::has('set_base_price')) {
	    $set = Setting::where("name", "=", "add_with_base_price")->first();
	    Session::put('set_base_price', $set->value);
	    $val = $set->value;
    } else {
	    $val = Session::get('set_base_price');
    }
	$price = ($price + $val);
    
    return ceilFive($price);
}

function ceilFive($number)
{
    $div = floor($number / 5);
    $mod = $number % 5;

    if ($mod > 0) $add = 5;
    else $add = 0;

    return number_format(($div * 5 + $add), 2);
}
function array_sort_by_column (&$arr, $col, $dir = SORT_ASC)
{
    $arr        = array_collapse($arr);
    $sort_col   = array();

    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}
