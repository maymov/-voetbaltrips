<?php

namespace App\Http\Controllers;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Sentinel;
use View;
use DB;
use App\Match;
use App\OrderMatch;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Translater\Languagetranslater;

class JoshController extends Controller {

	protected $countries = array(
			""   => "Select Country",
			"AF" => "Afghanistan",
			"AL" => "Albania",
			"DZ" => "Algeria",
			"AS" => "American Samoa",
			"AD" => "Andorra",
			"AO" => "Angola",
			"AI" => "Anguilla",
			"AR" => "Argentina",
			"AM" => "Armenia",
			"AW" => "Aruba",
			"AU" => "Australia",
			"AT" => "Austria",
			"AZ" => "Azerbaijan",
			"BS" => "Bahamas",
			"BH" => "Bahrain",
			"BD" => "Bangladesh",
			"BB" => "Barbados",
			"BY" => "Belarus",
			"BE" => "Belgium",
			"BZ" => "Belize",
			"BJ" => "Benin",
			"BM" => "Bermuda",
			"BT" => "Bhutan",
			"BO" => "Bolivia",
			"BA" => "Bosnia and Herzegowina",
			"BW" => "Botswana",
			"BV" => "Bouvet Island",
			"BR" => "Brazil",
			"IO" => "British Indian Ocean Territory",
			"BN" => "Brunei Darussalam",
			"BG" => "Bulgaria",
			"BF" => "Burkina Faso",
			"BI" => "Burundi",
			"KH" => "Cambodia",
			"CM" => "Cameroon",
			"CA" => "Canada",
			"CV" => "Cape Verde",
			"KY" => "Cayman Islands",
			"CF" => "Central African Republic",
			"TD" => "Chad",
			"CL" => "Chile",
			"CN" => "China",
			"CX" => "Christmas Island",
			"CC" => "Cocos (Keeling) Islands",
			"CO" => "Colombia",
			"KM" => "Comoros",
			"CG" => "Congo",
			"CD" => "Congo, the Democratic Republic of the",
			"CK" => "Cook Islands",
			"CR" => "Costa Rica",
			"CI" => "Cote d'Ivoire",
			"HR" => "Croatia (Hrvatska)",
			"CU" => "Cuba",
			"CY" => "Cyprus",
			"CZ" => "Czech Republic",
			"DK" => "Denmark",
			"DJ" => "Djibouti",
			"DM" => "Dominica",
			"DO" => "Dominican Republic",
			"EC" => "Ecuador",
			"EG" => "Egypt",
			"SV" => "El Salvador",
			"GQ" => "Equatorial Guinea",
			"ER" => "Eritrea",
			"EE" => "Estonia",
			"ET" => "Ethiopia",
			"FK" => "Falkland Islands (Malvinas)",
			"FO" => "Faroe Islands",
			"FJ" => "Fiji",
			"FI" => "Finland",
			"FR" => "France",
			"GF" => "French Guiana",
			"PF" => "French Polynesia",
			"TF" => "French Southern Territories",
			"GA" => "Gabon",
			"GM" => "Gambia",
			"GE" => "Georgia",
			"DE" => "Germany",
			"GH" => "Ghana",
			"GI" => "Gibraltar",
			"GR" => "Greece",
			"GL" => "Greenland",
			"GD" => "Grenada",
			"GP" => "Guadeloupe",
			"GU" => "Guam",
			"GT" => "Guatemala",
			"GN" => "Guinea",
			"GW" => "Guinea-Bissau",
			"GY" => "Guyana",
			"HT" => "Haiti",
			"HM" => "Heard and Mc Donald Islands",
			"VA" => "Holy See (Vatican City State)",
			"HN" => "Honduras",
			"HK" => "Hong Kong",
			"HU" => "Hungary",
			"IS" => "Iceland",
			"IN" => "India",
			"ID" => "Indonesia",
			"IR" => "Iran (Islamic Republic of)",
			"IQ" => "Iraq",
			"IE" => "Ireland",
			"IL" => "Israel",
			"IT" => "Italy",
			"JM" => "Jamaica",
			"JP" => "Japan",
			"JO" => "Jordan",
			"KZ" => "Kazakhstan",
			"KE" => "Kenya",
			"KI" => "Kiribati",
			"KP" => "Korea, Democratic People's Republic of",
			"KR" => "Korea, Republic of",
			"KW" => "Kuwait",
			"KG" => "Kyrgyzstan",
			"LA" => "Lao People's Democratic Republic",
			"LV" => "Latvia",
			"LB" => "Lebanon",
			"LS" => "Lesotho",
			"LR" => "Liberia",
			"LY" => "Libyan Arab Jamahiriya",
			"LI" => "Liechtenstein",
			"LT" => "Lithuania",
			"LU" => "Luxembourg",
			"MO" => "Macau",
			"MK" => "Macedonia, The Former Yugoslav Republic of",
			"MG" => "Madagascar",
			"MW" => "Malawi",
			"MY" => "Malaysia",
			"MV" => "Maldives",
			"ML" => "Mali",
			"MT" => "Malta",
			"MH" => "Marshall Islands",
			"MQ" => "Martinique",
			"MR" => "Mauritania",
			"MU" => "Mauritius",
			"YT" => "Mayotte",
			"MX" => "Mexico",
			"FM" => "Micronesia, Federated States of",
			"MD" => "Moldova, Republic of",
			"MC" => "Monaco",
			"MN" => "Mongolia",
			"MS" => "Montserrat",
			"MA" => "Morocco",
			"MZ" => "Mozambique",
			"MM" => "Myanmar",
			"NA" => "Namibia",
			"NR" => "Nauru",
			"NP" => "Nepal",
			"NL" => "Netherlands",
			"AN" => "Netherlands Antilles",
			"NC" => "New Caledonia",
			"NZ" => "New Zealand",
			"NI" => "Nicaragua",
			"NE" => "Niger",
			"NG" => "Nigeria",
			"NU" => "Niue",
			"NF" => "Norfolk Island",
			"MP" => "Northern Mariana Islands",
			"NO" => "Norway",
			"OM" => "Oman",
			"PK" => "Pakistan",
			"PW" => "Palau",
			"PA" => "Panama",
			"PG" => "Papua New Guinea",
			"PY" => "Paraguay",
			"PE" => "Peru",
			"PH" => "Philippines",
			"PN" => "Pitcairn",
			"PL" => "Poland",
			"PT" => "Portugal",
			"PR" => "Puerto Rico",
			"QA" => "Qatar",
			"RE" => "Reunion",
			"RO" => "Romania",
			"RU" => "Russian Federation",
			"RW" => "Rwanda",
			"KN" => "Saint Kitts and Nevis",
			"LC" => "Saint LUCIA",
			"VC" => "Saint Vincent and the Grenadines",
			"WS" => "Samoa",
			"SM" => "San Marino",
			"ST" => "Sao Tome and Principe",
			"SA" => "Saudi Arabia",
			"SN" => "Senegal",
			"SC" => "Seychelles",
			"SL" => "Sierra Leone",
			"SG" => "Singapore",
			"SK" => "Slovakia (Slovak Republic)",
			"SI" => "Slovenia",
			"SB" => "Solomon Islands",
			"SO" => "Somalia",
			"ZA" => "South Africa",
			"GS" => "South Georgia and the South Sandwich Islands",
			"ES" => "Spain",
			"LK" => "Sri Lanka",
			"SH" => "St. Helena",
			"PM" => "St. Pierre and Miquelon",
			"SD" => "Sudan",
			"SR" => "Suriname",
			"SJ" => "Svalbard and Jan Mayen Islands",
			"SZ" => "Swaziland",
			"SE" => "Sweden",
			"CH" => "Switzerland",
			"SY" => "Syrian Arab Republic",
			"TW" => "Taiwan, Province of China",
			"TJ" => "Tajikistan",
			"TZ" => "Tanzania, United Republic of",
			"TH" => "Thailand",
			"TG" => "Togo",
			"TK" => "Tokelau",
			"TO" => "Tonga",
			"TT" => "Trinidad and Tobago",
			"TN" => "Tunisia",
			"TR" => "Turkey",
			"TM" => "Turkmenistan",
			"TC" => "Turks and Caicos Islands",
			"TV" => "Tuvalu",
			"UG" => "Uganda",
			"UA" => "Ukraine",
			"AE" => "United Arab Emirates",
			"GB" => "United Kingdom",
			"US" => "United States",
			"UM" => "United States Minor Outlying Islands",
			"UY" => "Uruguay",
			"UZ" => "Uzbekistan",
			"VU" => "Vanuatu",
			"VE" => "Venezuela",
			"VN" => "Viet Nam",
			"VG" => "Virgin Islands (British)",
			"VI" => "Virgin Islands (U.S.)",
			"WF" => "Wallis and Futuna Islands",
			"EH" => "Western Sahara",
			"YE" => "Yemen",
			"ZM" => "Zambia",
			"ZW" => "Zimbabwe"
	);

	/**
	* Crop Demo
	*/
	public function crop_demo()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$targ_w = $targ_h = 150;
			$jpeg_quality = 99;

			$src    = base_path().'/public/assets/img/cropping-image.jpg';
			$img_r  = imagecreatefromjpeg($src);
			$dst_r  = ImageCreateTrueColor( $targ_w, $targ_h );

			imagecopyresampled($dst_r,$img_r,0,0,intval($_POST['x']),intval($_POST['y']), $targ_w,$targ_h, intval($_POST['w']),intval($_POST['h']));

			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$jpeg_quality);

			exit;
		}
	}

	/**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    /**
     * Initializer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;
	    Languagetranslater::getLanguage();
        //$countries can be accessed by any controller now
        view::share('countries',$this->countries);
    }

    public function showHome()
    {
    	if(!Sentinel::check())
    		return Redirect::to('admin/signin')->with('error', 'You must be logged in!');

    	$matches = Match::where("match_date", ">=", date('Y-m-d H:i:s'))->with('ordersMatch')->with('competitionSeatingGet')->with('competitionSeatingGet.seatingCategory')->orderBy('match_date')->paginate(10, ['*'], 'matches');

		$matches->setPageName('matches');

		$seatsOrdered = [];
		$seatsAvailable = [];

    	foreach($matches as $match) {
    		$seatsOrdered[$match->id] = [];
    		$seatsAvailable[$match->id] = [];

    		foreach($match->ordersMatch as $order) {
    			if(isset($seatsOrdered[$match->id][$order->seating_type])) {
    				$seatsOrdered[$match->id][$order->seating_type] += $order->quantity;
    			} else {
    				$seatsOrdered[$match->id][$order->seating_type] = (int)$order->quantity;
    			}
    		}
    		foreach($match->competitionSeatingGet as $seating) {
    			$seatsAvailable[$match->id][$seating->seatingCategory->name] = (int)$seating->quantity_available;
    		}
    	}

    	$orders = DB::table('orders as o')
			            ->join('orders_match as om', 'o.id', '=', 'om.orders_id')
			            ->join('orders_status as os', 'o.order_status', '=', 'os.id')
			            ->select('o.id', DB::raw("CONCAT(o.first_name,' ',o.last_name) as customerName"), 'om.home_club', 'om.away_club', 'om.match_date', 'o.order_total as total', 'o.created_at', 'os.name as status')
			            ->where('om.match_date', ">=", date('Y-m-d H:i:s') )
			            ->orderBy('om.match_date')->paginate(10, ['*'], 'orders');


		return View('admin/index')->with('matches',  $matches)
									->with('orders',  $orders)
									->with('seatsOrdered',  $seatsOrdered)
									->with('seatsAvailable',  $seatsAvailable);
			
    }

    public function showView($name=null)
    {
    	if(View::exists('admin/'.$name))
		{
			if(Sentinel::check())
				return View('admin/'.$name);
			else
				return Redirect::to('admin/signin')->with('error', 'You must be logged in!');
		}
		else
		{
			return View('admin/404');
		}
    }

    public function showFrontEndView($name=null)
    {
        if(View::exists($name))
        {
            return View($name);
        }
        else
        {
            return View('admin/404');
        }
    }


    public function calendar($name=null)
    {
		if(Sentinel::check()) {
			$matches = Match::with('getHomeClub')->with('getAwayClub')->whereDate("match_date", ">=", date('Y-m-d H:i:s'))->get();
			return View('admin/'.$name)->with('matches', $matches);
		}
		else {
			return Redirect::to('admin/signin')->with('error', 'You must be logged in!');
		}
}

    public function soldMatches() 
    {
    	if(!Sentinel::check())
    		return Redirect::to('admin/signin')->with('error', 'You must be logged in!');


    	$orders = DB::table('orders as o')
			            ->join('orders_match as om', 'o.id', '=', 'om.orders_id')
			            ->join('orders_status as os', 'o.order_status', '=', 'os.id')
			            ->select('om.matches_id as id', DB::raw("CONCAT(o.first_name,' ',o.last_name) as customerName"), 'om.home_club', 'om.away_club', 'om.match_date', 'o.order_total as total', 'o.created_at', 'os.name as status')
			            ->where('om.match_date', ">=", date('Y-m-d H:i:s') )
			            ->where('o.order_status', '=', 3)
			            ->orderBy('om.match_date')
			            ->groupBy('om.matches_id')
			            ->paginate(10);

		return View('admin/orders/sold')->with('orders',  $orders);
    }

    public function soldMatch($matchId, Request $request) 
    {
    	
    	if(!Sentinel::check()) {
    		return Redirect::to('admin/signin')->with('error', 'You must be logged in!');
    	}

        $orders = DB::select("
        	SELECT 
			  `o`.`id`,
			  CONCAT(o.first_name, ' ', o.last_name) AS customerName,
			  `o`.`order_total` AS total,
			  om.actual_price + of.actual_price + a.actual_price AS totalActual
			FROM orders o
			Left JOIN orders_match om
			ON o.id = om.orders_id
			left join (
			  SELECT
			    o.id, 
			    f.actual_price
			  FROM orders o
			  left JOIN orders_flight f
			  ON o.id = f.orders_id
			  WHERE o.order_status = 3
			  GROUP BY f.orders_id
			) as of
			ON o.id = of.id
			INNER JOIN orders_accomodation a
			ON a.orders_id = o.id
			WHERE o.order_status = 3
			AND om.match_date > NOW()
			AND om.matches_id = ".$matchId."
			ORDER BY
			om.match_date
        ");


		$totalProfit = 0;
        $totalNetProfit = 0;
        $totalBTW = 0;

        $orders = collect($orders)->map(function($order) use (&$totalProfit, &$totalNetProfit, &$totalBTW) {
        	$order->profit = $order->total - $order->totalActual;
        	$order->netProfit = $order->profit / 1.21;
        	$order->btw = $order->profit - $order->netProfit;

        	$totalProfit += $order->profit;
        	$totalNetProfit += $order->netProfit;
        	$totalBTW += $order->btw;

        	return $order;
        });

        $orders = $this->arrayPaginator($orders->all(), $request);

		return View('admin/orders/soldList', compact('totalProfit', 'totalNetProfit', 'totalBTW', 'orders'));
    }

    public function arrayPaginator($array, Request $request)
	{
	    $page = $request->get('page', 1);
	    $perPage = 10;
	    $offset = ($page * $perPage) - $perPage;

	    return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
	        ['path' => $request->url(), 'query' => $request->query()]);
	}
}
