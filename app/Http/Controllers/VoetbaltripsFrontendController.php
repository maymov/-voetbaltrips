<?php
namespace App\Http\Controllers;
use Activation;
use App\Accomodation;
use App\AccomodationImages;
use App\Airports;
use App\Cities;
use App\Club;
use App\Competition_seating;
use App\Country;
use App\Flight;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\OrderMatch;
use App\Stadium;
use App\Tournament;
use App\TransCity;
use App\User;
use Barryvdh\Debugbar\DataCollector\SessionCollector;
use Carbon\Carbon;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Mockery\Exception;
use Redirect;
use Reminder;
use Sentinel;
use URL;
use View;
use App\Match;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Cart;
use App\UsersCart;
use Validator;
use DB;
use App\Airportlist;
use App\Option;
use DateTime;
use Translater;
use Session;
use App\Discount;

class VoetbaltripsFrontendController extends JoshController
{
    /**
     * Index.
     *
     * @return View
     */
    public function getIndex(Request $request)
    {
        $city_uri       = '';
        $club_uri       = '';
        $tournament_uri = '';
        $club           = Club::orderBy('name','asc')->get();
        $c              = Club::with("getCity")->groupBy("city")->lists("city");
        $city           = TransCity::where('lang_code', Session::get('lang_code'))->whereIn("city_id", $c)->orderBy('trans_name')->get();
        $tournaments    = Tournament::where("end_date",">=", date("Y-m-d"))->orderBy("name", "asc")->get();
        $ajaxload_match = "yes";
        $matches        = [];
        $clubId = 0;
        $cityId = 0;
        $tournamentId = 0;
        $matchId = 0;

        if ($request->session()->has('only_ticket')) {
            $request->session()->remove('only_ticket');
        }
        if ($request->has("city")) {
            $city_uri       = urldecode(trim($request->input("city")));
            if($city_uri) {
                $cityFirst= Cities::where('name', $city_uri)->first();
                if(isset($cityFirst->id))
                {
                    $cityId = $cityFirst->id;
                }
            }
            $ajaxload_match = "yes";
        }
        if ($request->has("club")) {
            $club_uri       = urldecode(trim($request->input("club")));
            if($club_uri) {
                $clubFirst = Club::where('name', $club_uri)->first();
                if(isset($clubFirst->id))
                {
                    $clubId = $clubFirst->id;
                }
            }
            $ajaxload_match = "yes";
        }
        if ($request->has("tournament")) {
            $tournament_uri = urldecode(trim($request->input("tournament")));
            if($tournament_uri) {
                $tournamentFirst = Tournament::where('name', $tournament_uri)->first();
                if(isset($tournamentFirst->id))
                {
                    $tournamentId = $tournamentFirst->id;
                }
            }
            $ajaxload_match = "yes";
        }
        if ($request->has("match")) {
            $matchId = $request->input("match");
        }

        return View::make('voetbaltrips_frontend.index', compact('clubId', 'club', 'city', 'tournaments', 'cityId', 'city_uri', 'club_uri', 'tournamentId','tournament_uri', 'matches', 'ajaxload_match', 'matchId'));
    }

    /**
     *
     * When the user change the city then there also need to show the matches held in the specific city
     *
     * @param $city
     * @return mixed
     */
    private function getAjaxClubs($cities)
    {
        if(count($cities) > 1){
            $clubs  = Club::whereIn('city', $cities)->get();
        } else {
            $clubs  = Club::where('city','=', $cities)->get();
        }
        return $clubs;
    }

    public function getAjaxCities(Request $request)
    {
        $cities = Cities::where("country_id", "=", $request->input("country_id"))->select("name", "id")->get();
        return response()->json(array("cities"=>$cities));
    }

    public function getAjaxCitiesByTournament($tournament, $return_array = false)
    {

        $matches = Match::where('tournament', $tournament)->get();
        $citiesIds = [];

        $cities = DB::table('clubs as c1')
            ->join('cities as c2', 'c1.city', '=', 'c2.id')
            ->select('c2.id')
            ->get();

        foreach($cities as $city) {
            $citiesIds[] = $city->id;
        }

        if($return_array) {
            return $citiesIds;
        }

         $citiesWithCountry = DB::table('cities as c1')
            ->join('country as c2', 'c1.country_id', '=', 'c2.id')
            ->join('trans_city as t1', 'c1.id', '=', 't1.city_id')
            ->join('trans_country as t2', 'c2.id', '=', 't2.country_id')
            ->where('t1.lang_code', '=', Session::get('lang_code'))
            ->where('t2.lang_code', '=', Session::get('lang_code'))
            ->whereIn('c1.id',$citiesIds)
            ->orderby('c2.name', 'ASC')
            ->orderby('c1.name', 'ASC')
            ->select('c1.*', 'c2.flag', 't1.trans_name as cityName', 't2.trans_name as countryName')
            ->get();

        return $citiesWithCountry;
    }

    public function getAjaxClubsByTournament($tournament)
    {

        $matches = Match::where('tournament', $tournament)->get();
        $clubsIds = [];
        $clubs = [];

        foreach($matches as $match) {
            if(!in_array($match->getHomeClub->city, $clubsIds)) {
                $clubsIds[] = $match->getHomeClub->id;
                $clubs[] = $match->getHomeClub;
            }
            if(!in_array($match->getAwayClub->city, $clubsIds)) {
                $clubsIds[] = $match->getAwayClub->id;
                $clubs[] = $match->getAwayClub;
            }
        }

        return $clubs;
    }

    public function getAjaxTournamentsForDD()
    {
        $tournaments = Tournament::where("end_date",">=", date("Y-m-d"))->orderBy("name", "asc")->get();
        return response()->json(array("tournaments"=>$tournaments));
    }

    public function getAjaxCitiesForDD(Request $request)
    {
        if($request->input('tournament')) {
            $cities = $this->getAjaxCitiesByTournament($request->input("tournament"), false);
        } else {
            $matches = Match::all();
            $citiesIds = [];

            foreach($matches as $match) {
                if(!in_array($match->getHomeClub->city, $citiesIds)) {
                    $citiesIds[] = $match->getHomeClub->city;
                }
                if(!in_array($match->getAwayClub->city, $citiesIds)) {
                    $citiesIds[] = $match->getAwayClub->city;
                }
            }

             $cities = DB::table('cities as c1')
                ->join('country as c2', 'c1.country_id', '=', 'c2.id')
                ->join('trans_city as t1', 'c1.id', '=', 't1.city_id')
                ->join('trans_country as t2', 'c2.id', '=', 't2.country_id')
                ->where('t1.lang_code', '=', Session::get('lang_code'))
                ->where('t2.lang_code', '=', Session::get('lang_code'))
                ->whereIn('c1.id',$citiesIds)
                ->orderby('c2.name', 'ASC')
                ->orderby('c1.name', 'ASC')
                ->select('c1.*', 'c2.flag', 't1.trans_name as cityName', 't2.trans_name as countryName')
                ->get();
        }

        return response()->json(array("cities"=>$cities));
    }

    public function getAjaxClubsForDD(Request $request)
    {
        if($request->input('city')) {
            $clubs = Club::where('city',$request->input('city'))->get();
        } elseif($request->input('tournament')) {
            $clubs = $this->getAjaxClubsByTournament($request->input("tournament"));
        } else {
            $clubs = Club::all();
        }

        return response()->json(array("clubs"=>$clubs));
    }

    public function dropdowns() 
    {
        $citiesIds = []; 
        $clubs = Club::all();

        $tournaments = Tournament::where("end_date",">=", date("Y-m-d"))->orderBy("name", "asc")->get();

        $cities = DB::table('clubs as c1')
            ->join('cities as c2', 'c1.city', '=', 'c2.id')
            ->select('c2.id')
            ->get();

        foreach($cities as $city) {
            $citiesIds[] = $city->id;
        }

         $citiesWithCountry = DB::table('cities as c1')
            ->join('country as c2', 'c1.country_id', '=', 'c2.id')
            ->join('trans_city as t1', 'c1.id', '=', 't1.city_id')
            ->join('trans_country as t2', 'c2.id', '=', 't2.country_id')
            ->where('t1.lang_code', '=', Session::get('lang_code'))
            ->where('t2.lang_code', '=', Session::get('lang_code'))
            ->whereIn('c1.id',$citiesIds)
            ->orderby('c2.name', 'ASC')
            ->orderby('c1.name', 'ASC')
            ->select('c1.*', 'c2.flag', 't1.trans_name as cityName', 't2.trans_name as countryName')
            ->get();

        $response[] = $citiesWithCountry;
        $response[] = $clubs;
        $response[] = $tournaments;

        return response()->json(array('response' => $response));
    }

    /**
     *
     */
    public function getImagesFromStorage($category, $filename)
    {
        $exists = File::exists(base_path()."/public/uploads/".$category.'/'.$filename);
        if ($exists) {
            $file       = base_path()."/public/uploads/".$category.'/'.$filename;
            $mimetype   = File::mimeType($file);
            $response   = Response::make($file, 200);
            $response->header("Content-Type", $mimetype);
            return $response;
        }
    }

    public function getAjaxMatches(Request $request)
    {

        $resp['cities'] = [];
        if ($request->input("loadcities") == "yes") {
            $resp['cities'] = $this->getAjaxCitiesByTournament($request->input("tournament"), false);
        }

        $resp['clubs'] = [];
        if ($request->input("loadclub") == "yes") {
            if (count($resp['cities']) > 0) {
                $resp['clubs'] = $this->getAjaxClubs($this->getAjaxCitiesByTournament($request->input("tournament"), true));
            } else {
                $resp['clubs'] = $this->getAjaxClubs($request->input("city"));
            }
        }

        if (!empty($request->input("match_date"))) {
            $getmatch = Match::whereDate("match_date", "=", date('Y-m-d' , strtotime($request->input("match_date"))));
        } elseif($request->input("matchId") && $request->input("matchId") != 0) {
            $getmatch = Match::where("id", $request->input("matchId"));
        }
        else {
            $getmatch = Match::whereDate("match_date", ">=", date('Y-m-d H:i:s'));
        }

        if (!empty($request->input("tournament"))) {
            $getmatch->where("tournament", "=", $request->input("tournament"));
        }

        if (!empty($request->input("club")) && $request->input("loadclub") != "yes") {
            $club = $request->input('club');
            $getmatch->where(function ($q) use ($club) {
                $q->where("home_club", $club);
                $q->orWhere("away_club", $club);
            });
        }

        if (!empty($request->input("city"))) {
            $city = $request->input("city");
            $getmatch->whereHas('getStadium', function($q) use($city) {
                $q->where('city', '=', $city);
            });
        }

        /**
         * This is to check whether match has any tickets created
         * there will only list matches who have created tickets
         */
        $getmatch->whereHas("competitionSeatingGet", function($q){
            $q->where("price", ">", 0);
        });

        /**
         * There is need to check whether there is any Departure or return  flight is added to nearest airport
         * If there is no flight is added then we can skip the match from search listing
         *
         */
         $getmatch->whereHas('getStadium', function($q){
            $q->whereHas('getAllAirport', function ($qa) {
                $qa->whereHas("flightTo", function ($qb)  {
                    $qb->whereRaw(DB::raw("arrive_date between DATE_FORMAT(DATE_SUB(matches.`match_date`, INTERVAL 3 DAY), '%Y-%m-%d') and DATE_FORMAT(matches.`match_date`, '%Y-%m-%d')"));
                    $qb->where("flightmode", "=", 1);
                    //$qb->where("arrive_time", "<", date('H:i:s', strtotime("matches.`match_date`" . "- 3 hour")));
                });
            });
         });

         $getmatch->whereHas('getStadium', function($q) {
            $q->whereHas('getAllAirport', function ($qa) {
                $qa->whereHas("flightFrom", function ($qb) {
                    $qb->whereRaw(DB::raw("departure_date between DATE_FORMAT(matches.`match_date`, '%Y-%m-%d') and DATE_FORMAT(DATE_ADD(matches.`match_date`,INTERVAL 2 DAY), '%Y-%m-%d')"));
                    $qb->where("flightmode", "=", 2);
                    $qb->where("departure_time", ">", date("H-i-s", strtotime("matches.`match_date`" . "+ 5 hour")));
                });
            });
        });

        /**
         * Check that any hotel is added to the city
         **/
        $getmatch->whereHas('getStadium', function($q) {
            $q->whereHas('cities', function ($qa) {
                $qa->whereHas("accomodation", function ($qb) {
                    $qb->where("created_at", "!=", "NULL");
                });
            });
        });
        //dd($getmatch->get());
        /**
         * To check that tournament is ended or not
         */
        $getmatch->whereHas("getTournament", function ($q) {
            $q->where("end_date", ">=", date("Y-m-d"));
        });

        /**
         * To check seats available
         */
        $getmatch->orderby("match_date", "asc");

        //dd($getmatch->get());

        //return response()->json($getmatch->toSql());
        $match_result     = $getmatch->get();
        $result           = [];

//TODO Stas 25.05

        foreach($match_result as $key=>$val) {
            if (empty($val->competitionSeatingGet->min('price'))) {
                break;
            }
            $val->setoptions        = [];
            $val->cost_arr          = 0;
            $val->cost_dep          = 0;
            $val->days_in_toure     = 0;
            $val->cost_toure        = 0;

            $match_date             = date('Y-m-d', strtotime($val->match_date));
            $match_time             = date('H:i:s', strtotime($val->match_date));
            $dat_time_arr_before    = date('Y-m-d H:i:s', strtotime($val->match_date .' -5 hour'));
            $dat_time_dep_after     = date('Y-m-d H:i:s', strtotime($val->match_date .' +5 hour'));
            $dat_match_end          = date('Y-m-d', strtotime($dat_time_dep_after));

            $multi_airport          = $val->getStadium->getAllAirport;
            $match                  = [];
            $date_max_val_arr       = date('Y-m-d', strtotime($dat_time_arr_before .' -3 day'));
            $time_arr_before        = date('H:i:s', strtotime($dat_time_arr_before));
            $time_dep_after         = date('H:i:s', strtotime($dat_time_dep_after));
            $date_max_val_dep       = date('Y-m-d', strtotime($dat_time_dep_after .' +3 day'));
            $all_arrived            = [];
            $all_depparted          = [];

            foreach ($multi_airport as $air) {
                $current_flight_dep = $air->flightTo()
                    ->where("departure_date", ">=", $date_max_val_arr)
                    ->where("arrive_date", "<=", $match_date)
                    ->orderby("departure_date","price", "asc")
                    ->get();

                $current_flight_arr = $air->flightFrom()
                    ->where("departure_date", ">=", $dat_match_end)
                    ->where("arrive_date", "<=", $date_max_val_dep)
                    ->orderby("departure_date", "price", "asc")
                    ->get();
                //dd($current_flight_arr);
                foreach ($current_flight_dep as $cur) {
                    if (array_key_exists($cur->departure_date, $all_arrived)) {
                        if (array_key_exists($cur->from, $all_arrived[$cur->departure_date])) {
                            if ($cur->arrive_date == $match_date && $cur->arrive_time <= $time_arr_before && $all_arrived[$cur->departure_date][$cur->from]['price'] > $cur->price) {
                                $all_arrived[$cur->departure_date][$cur->from] = $cur;
                            }
                            if ($all_arrived[$cur->departure_date][$cur->from]['price'] > $cur->price && $cur->arrive_date != $match_date) {
                                $all_arrived[$cur->departure_date][$cur->from] = $cur;
                            }
                        } else if (($cur->arrive_time <= $time_arr_before && $cur->arrive_date == $match_date) || ($cur->arrive_date != $match_date)) {
                            $all_arrived[$cur->departure_date][$cur->from] = $cur;
                        }
                    } else if (($cur->arrive_time <= $time_arr_before && $cur->arrive_date == $match_date) || ($cur->arrive_date != $match_date)) {
                        $all_arrived[$cur->departure_date][$cur->from] = $cur;
                    }
                }

                foreach ($current_flight_arr as $arr) {
                    if (array_key_exists($arr->departure_date, $all_depparted)) {
                        if (array_key_exists($arr->to, $all_depparted[$arr->departure_date])) {
                            if ($arr->departure_date == $dat_match_end && $arr->departure_time >= $time_dep_after && $all_depparted[$arr->departure_date][$arr->to]['price'] > $arr->price) {
                                $all_depparted[$arr->departure_date][$arr->to] = $arr;
                            }
                            if ($arr->departure_date != $dat_match_end && $all_depparted[$arr->departure_date][$arr->to]['price'] > $arr->price) {
                                $all_depparted[$arr->departure_date][$arr->to] = $arr;
                            }
                        }else if (($arr->departure_time >= $time_dep_after && $arr->departure_date == $dat_match_end) || ($arr->departure_date != $dat_match_end)) {
                            $all_depparted[$arr->departure_date][$arr->to] = $arr;
                        }
                    } else if (($arr->departure_time >= $time_dep_after && $arr->departure_date == $dat_match_end) || ($arr->departure_date != $dat_match_end)) {
                        $all_depparted[$arr->departure_date][$arr->to] = $arr;
                    }
                }
            }
            $out_fl         = null;
            $in_fl          = null;
            $hotel_price    = Accomodation::where("city", "=", $val->getStadium->city)
                            ->min("low_season_prices");
            $array          = [];

            foreach ($all_arrived as $v_dep => $dep) {
                foreach ($all_depparted as $v_arr => $arr) {
                    foreach ($dep as $id_d => $d) {
                        foreach ($arr as $id_a => $a) {
                            if ($id_d == $id_a) {
                                $dat_arr = new DateTime($v_dep);
                                $dat_dep = new DateTime($v_arr);
                                $interval = $dat_dep->diff($dat_arr);
                                $days_book = $interval->d;
                                $cost = addAdditionalPrice($a->price) + addAdditionalPrice($d->price) + addAdditionalPrice($hotel_price * $days_book);
                                $array[] = [
                                    'price' => $cost,
                                    'day' => $days_book,
                                    'from' => $a->from,
                                    'to' => $d->to,
                                    'date_dep' => $dat_dep,
                                    'date_arr' => $dat_arr,
                                    'a_pr' => addAdditionalPrice($a->price),
                                    'd_pr' => addAdditionalPrice($d->price)
                                ];

                                if ($val->cost_toure == 0 || $val->cost_toure > $cost) {
                                    $val->cost_toure    = $cost;
                                    $val->days_in_toure = $days_book;
                                    $in_fl              = $d;
                                    $out_fl             = $a;
                                }
                            }
                        }
                    }
                }
            }
            $mass = [
                'in_fl'     => $in_fl->id,
                'out_fl'    => $out_fl->id,
            ];

            $request->session()->set("match_pack_$val->id", $mass);

            if(!isset($in_fl->id) || !isset($out_fl->id)) {
                break;
            }

            foreach ($val->getStadium->country->getTranslate as $country) {
                if ($country->lang_code == Session::get('lang_code')) {
                    $match[$key]['country_name']    = $country->trans_name;
                }
            }
            foreach ($val->getStadium->cities->getTranslate as $city) {
                if ($city->lang_code == Session::get('lang_code')) {
                    $match[$key]['city_name']    = $city->trans_name;
                }
            }

            $match[$key]['tournament']      = $val->getTournament->name;
            $match[$key]['stadium']         = $val->getStadium->stadium;
            $image                          = url("assets/img/no-image-available.png");

            if (File::exists(base_path(). '/public/uploads/matches/'.$val->image_name) and !empty($val->image_name)) {
                $image = url("uploads/matches/".$val->image_name);
            }

            $match[$key]['image']               = $image;
            $match[$key]['home_club']           = $val->getHomeClub->name;
            $match[$key]['away_club']           = $val->getAwayClub->name;
            $match[$key]['home_club_emblem']    = "/uploads/teamemblems/" . $val->getHomeClub->emblem;
            $match[$key]['away_club_emblem']    = "/uploads/teamemblems/" . $val->getAwayClub->emblem;
            $match[$key]['match_date']          = date("d", strtotime($val->match_date));
            $match[$key]['match_month']         = date("M", strtotime($val->match_date));
            $match[$key]['match_id']            = $val->id;
            $match[$key]['min_price']           = addAdditionalPrice($val->competitionSeatingGet->min('price')) + $val->cost_toure;
            $match[$key]['button_book']         = Translater::getValue('button-book-now');
            $match[$key]['label_since']         = Translater::getValue('label-since-small');

            if (!empty($match)) {
                $sort_array = array_values(array_sort($match, function ($value) {
                    return $value['min_price'];
                }));

                $best_cost = head($sort_array);
                $result[$key][] = $best_cost;
            }
        }
        $sort_type  = $request->input("sorttype");
        $sort_order = $request->input("sortorder");

        // TODO ???????? ??????????
        if ($sort_type!="" and $sort_order !="") {
            $arr = array_collapse($result);
            echo "<pre>";
        //    print_r($arr);
            switch ($sort_type) {
                case "price" :
                    $sort_array = array_values(array_sort($arr, function ($value) {
                        return $value['min_price'];
                    }));

                    $result = $sort_array;
                    break;
                case "date":
                    $sort_array = array_values(array_sort($arr, function ($value) {
                        return $value['match_date'];
                    }));

                    $result = $sort_array;
                    break;
                default :
            }
            $order = (($sort_order == "asc")? SORT_ASC : SORT_DESC);
            if ($order == SORT_DESC) {
                $result[0] = array_reverse($result[0]);
            }
        }
        $resp['matches']  = $result;
        //dd($result);
        if (empty($resp['matches'])) {
            $resp['matches']['status']  = "empty";
            $resp['matches']['message'] = Translater::getValue('message-no-matches-found');
        }
        return response()->json($resp);
    }
    /**
     *
     * @param $match_id
     * @param Request $request
     * @return mixed
     *
     * This function save the package into the cart.
     * Saving the all data such as ticket, flight, accommodation.
     *
     */
    //TODO 25.05 rewrite flight finding for cart
    public function addPackageToCart($match_id, Request $request)
    {
        $response['status']   = "error";
        $response['message']  = "Unable to add the package to Cart";
        $match                = Match::findOrFail($match_id);
        /**
         * first check that any package is already added in the cart.
         * if any package is added then show message that already added.
         * if there is no package is added then add the package to the cart.
         * save the quantity as 1
         */

        if($request->session()->has("cart_match")) {
            $response['message'] = Translater::getValue('message-you-have-already-selected-a-ticket');;
        } else {
            $ticket = $match->competitionSeatingGet()->where('quantity_available','>', 0)->orderby('price', "asc")->first();

            $match_array = [
                "name"          => $match->getHomeClub->name." - ". $match->getAwayClub->name." (".$ticket->seatingCategory->name." Ticket)",
                "price"         => addAdditionalPrice($ticket->price),
                "identifier"    => $ticket->id,
                "for_cart"      => $match->getHomeClub->name." - ". $match->getAwayClub->name." ".date("d-m-Y", strtotime($match->match_date))
            ];

            $fl_arr = $request->session()->get("match_pack_$match_id");

            if (!$fl_arr) {
                throw new Exception('Have not flights data');
            }

            $fl_in = Flight::find($fl_arr['in_fl']);
            $fl_out = Flight::find($fl_arr['out_fl']);

            $flight_array = [
                "name"              => "Flight Ticket",
                "dept_flight"       => $fl_in->id,
                "return_flight"     => $fl_out->id,
                "date_flight_dep"   => $fl_in->departure_date,
                "date_flight_arr"   => $fl_out->departure_date
            ];

            $accomo = $match->getStadium->cities->accomodation()
                ->orderby("low_season_prices", "asc")
                ->first();

            /**
             *  Date period
             */
            $date_dep = new DateTime($flight_array['date_flight_dep']);
            $date_arr = new DateTime($flight_array['date_flight_arr']);

            $interval      = $date_dep->diff($date_arr);
            $days_book     = $interval->d; // Booking days is equal to the difference of flight dates

            $cart_array    = [
                "name"              => $accomo->name,
                "price"             => addAdditionalPrice($accomo->low_season_prices),
                "accomo_id"         => $accomo->id,
                "include_breakfast" => "",
                "room_days"         => $days_book
            ];

            $request->session()->set("cart_quantity", 1);
            $request->session()->set("cart_match", $match_id);
            $request->session()->set("match_data", $match_array);
            $request->session()->set("cart_flight", $flight_array);
            $request->session()->set("cart_room", $cart_array);
            $response['status']  = "success";
            $response['message'] = "Package has been added to cart.";
        }
        return response()->json($response);
    }

    public function getMatch($match_id, Request $request)
    {
        if (!$request->session()->has("cart_match") and $request->session()->get("cart_match") != $match_id) {
            return redirect(url());
        }
        $cart_match = $request->session()->get("match_data");
        $cart_qty   = $request->session()->get("cart_quantity");
        $match      = Match::findOrFail($match_id);
        $fixed      = [];

        if ($match->fixed_data == 0) {
            $fixed['val'] = $match->fixed_data;
            $fixed['title'] = Translater::getValue('form-label-information');
            $fixed['text']  = Translater::getValue('form-info-the-date-of-this-match-is-not-fixed');
        }

        return View::make('voetbaltrips_frontend.match', [
                    "match"         => $match,
                    "match_id"      => $match_id,
                    "cart_match"    => $cart_match,
                    "cart_qty"      => $cart_qty,
                    "fixed"         => $fixed
        ]);
    }
    /**
     * @param $match_id
     * @param Request $request
     * @return Redirect
     * Here check that user has already selected any match
     * if user selected any match then there cannot select another match
     */
    public function addMatchToCart($match_id, Request $request)
    {
        $response['status']  = "error";
        $response['message'] = "Unable to add match ticket to the cart";
        $rules =[
            "ticket"          => "required",
            "ticket_quantity" => "required"
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response['message'] = "Seating type and number of tickets is required to book a match";
            return response()->json($response);
        }
        /**
         * Checking that required quantity of ticket is available to buy
         * If there is no enough quantity then it will return error
         */
        $checkQuantityAvailable = $this->checkMatchTicketAvailable($match_id, $request->all());

        if ($checkQuantityAvailable['status'] == "error") {
            return response()->json($checkQuantityAvailable);
        }

        $match               = Match::find($match_id);
        $ticket_price        = Competition_seating::find($request->input("ticket"));
        $request->session()->set("cart_quantity", $request->input("ticket_quantity"));

        $match_array     = [
            "name"       => $match->getHomeClub->name." - ". $match->getAwayClub->name." (".$ticket_price->seatingCategory->name." Ticket)",
            "price"      => addAdditionalPrice($ticket_price->price),
            "identifier" => $request->input("ticket"),
            "for_cart"      => $match->getHomeClub->name." - ". $match->getAwayClub->name." ".date("d-m-Y", strtotime($match->match_date))
        ];

        $request->session()->set("match_data", $match_array);
        $response['status']   = "success";
        $response['message']  = "Package updated.";

        return response()->json($response);
    }

    private function checkMatchTicketAvailable($match_id, $request)
    {
        $response['status']  = "error";
        $response['message'] = "There is no enough tickets are available to purchase";
        $ticket_details      = Competition_seating::find($request['ticket']);
        $total_tickets       = $ticket_details->quantity_available;
        /**
         * Finding how many tickets are already sold out
         */
        $orders_match        = DB::table("orders_match")
                                ->selectRaw("sum(orders_match.quantity) as sold_ticket")
                                ->where("orders_match.matches_id", "=", $match_id)
                                ->where("orders_match.seat_type", "=", $request['ticket'])
                                ->join("orders", "orders.id", "=", "orders_match.orders_id")
                                ->where("orders.payment_status", "=", 2)
                                ->first();
        $sold_tickets        = $orders_match->sold_ticket;
        $available_tickets   = ($total_tickets - $sold_tickets);
        /**
         * Now Checking that is there enough tickets that are needed for user requirement
         */
        if (($available_tickets - $request['ticket_quantity']) >=0) {
            $response['status']  = "success";
            $response['message'] = "There is enough tickets are available";
        }
        return $response;
    }

    /**
     * Showing flight information for the match
     * There should show flights departure and arrival
     * Departure flights should shown one day before the match date
     * Return flights should be shown one day after the match date
     * @param $match_id
     * @return View
     */

    public function flightSelection($match_id, Request $request)
    {
        if (!$request->session()->has("cart_match")) {
            return redirect(url());
        }
        $match      = Match::findorFail($match_id);
        $test       = Airportlist::where('city_id', $match->getStadium->cities->id)->lists('id');
        $air        = Flight::where("flightmode", 1)->whereIn("to", $test)->groupBy("from")->lists('from');
        $airports   = Airportlist::whereIN("id", $air)->get();

        $request->session()->set('airport_from', $air);

        return view('voetbaltrips_frontend.flight', [
            "match_id"          => $match_id,
            "match"             => $match,
            "airports"          => $airports,
        ]);
    }
    /**
     * 3 functions for flight ticket
     */
    public function searchFlights(Request $request)
    {
        $response = [];
        $response['status']     = "error";
        $match                  = Match::find($request->input("match_id"));
        $match_date             = date('Y-m-d', strtotime($match->match_date));
        
        if ($match->fixed_data  == 1) {
            $time_before_match  = date('H:i:s', strtotime($match->match_date . ' - 5 hour'));
            $time_after_match   = date('H:i:s', strtotime($match->match_date . ' + 6 hour'));
            $match_end_date     = date('Y-m-d', strtotime($match->match_date . ' + 6 hour'));
        } elseif ($match->fixed_data == 0) {
            $date_before_match  = date('Y-m-d', strtotime($match->match_date . ' - 6 hour'));
            $time_before_match  = date('H:i:s', strtotime($match->match_date . ' - 3 hour'));
            $time_after_match   = date('H:i:s', strtotime($match->match_date . ' + 36 hour'));
            $match_end_date     = date('Y-m-d', strtotime($match->match_date . ' + 2 day'));
        }
        $cart_flight            = $request->session()->get("cart_flight");
        $airports_in_city       = Airportlist::where("city_id", "=", $match->getStadium->cities->id)->lists('id');
        $out_price              = Flight::select('price')->find($cart_flight['dept_flight']);
        $ret_price              = Flight::select('price')->find($cart_flight['return_flight']);
        $req_airports           = $request->session()->get('airport_from');
        $out_min_price          = addAdditionalPrice($out_price->price);
        $ret_min_price          = addAdditionalPrice($ret_price->price);

        session()->set('min_flight_arr', $out_min_price);
        session()->set('min_flight_dep', $ret_min_price);
//var_dump($match->match_date, $time_before_match);
        if ($request->input('airports') != '') {
            $req_airports = explode(',', $request->input('airports'));
        }
        $outgoing_flight        = Flight::with("destination_airport", "source_airport", "airline")->where("flightmode", "=", 1);
        $return_flight          = Flight::with("destination_airport", "source_airport", "airline")->where("flightmode", "=", 2);

        if ($request->input('day_mode') != '' && $request->input('day_val') != ''
                && $request->input('day_form_out') != '' && $request->input('day_form_ret') != '') {

            $d_form_out = date('Y-m-d', strtotime($request->input('day_form_out')));
            $d_form_ret = date('Y-m-d', strtotime($request->input('day_form_ret')));

            if ($request->input('day_mode') == "outfliy") {
                $d_out = date('Y-m-d', strtotime($d_form_out . $request->input('day_val')));
                
                if ($match->fixed_data == 0) {
                    if ($d_out < $match_date) {
                    $outgoing_flight->where("arrive_date", $d_out)
                        ->whereIn("to", $airports_in_city)
                        ->whereIn("from", $req_airports);
                    } else if ($d_out == $match_date) {
                        $outgoing_flight->where("arrive_date", $d_out)
                            ->where("arrive_time", "<=", $time_before_match)
                            ->whereIn("to", $airports_in_city)
                            ->whereIn("from", $req_airports);
                    } else {
                        $outgoing_flight = 'Wrong date';
                    }
                }
                
                if ($match->fixed_data == 1) {
                    if ($d_out < $match_date) {
                    $outgoing_flight->where("arrive_date", $d_out)
                        ->whereIn("to", $airports_in_city)
                        ->whereIn("from", $req_airports);
                    } else if ($d_out == $match_date) {
                        $outgoing_flight->where("arrive_date", $d_out)
                            ->where("arrive_time", "<=", $time_before_match)
                            ->whereIn("to", $airports_in_city)
                            ->whereIn("from", $req_airports);
                    } else {
                        $outgoing_flight = 'Wrong date';
                    }
                }

                if ($d_form_ret > $match_end_date) {
                    $return_flight->where("arrive_date", $d_form_ret)
                        ->whereIn("from", $airports_in_city)
                        ->whereIn("to", $req_airports);
                } else if ($d_form_ret == $match_end_date) {
                    $return_flight->where("arrive_date", $d_form_ret)
                        ->where("departure_time", ">=",  $time_after_match)
                        ->whereIn("from", $airports_in_city)
                        ->whereIn("to", $req_airports);
                } else {
                    $return_flight = 'Wrong date';
                }

            } else if ($request->input('day_mode') == "return") {
                $d_ret = date('Y-m-d', strtotime($d_form_ret . $request->input('day_val')));

                if ($d_ret > $match_end_date) {
                    $return_flight->where("departure_date", $d_ret)
                        ->whereIn("from", $airports_in_city)
                        ->whereIn("to", $req_airports);
                } else if ($d_ret == $match_end_date) {
                    $return_flight->where("departure_date", $d_ret)
                        ->where("departure_time", ">=", $time_after_match)
                        ->whereIn("from", $airports_in_city)
                        ->whereIn("to", $req_airports);
                } else {
                    $return_flight = 'Wrong date';
                }

                if ($d_form_out < $match_date) {
                    $outgoing_flight->where("arrive_date", $d_form_out)
                                    ->whereIn("to", $airports_in_city)
                                    ->whereIn("from", $req_airports);
                } else if ($d_form_out == $match_date) {
                    $outgoing_flight->where("arrive_date", $d_form_out)
                                    ->where("arrive_time", "<=", $time_before_match)
                                    ->whereIn("to", $airports_in_city)
                                    ->whereIn("from", $req_airports);
                } else {
                    $outgoing_flight = 'Wrong date';
                }
            }
        } else {
            //initial page loading

            //if home club is Everton or Liverpool
            //finding airports from Manchester and Liverpool
            if ($match->home_club == 10 ||  $match->home_club == 13) {
                $airports_in_city = $airports_in_city->merge([6, 11])->unique()->toArray();
            }

            if ($match->fixed_data == 0) {
//                $outgoing_flight->where("arrive_date", $cart_flight['date_flight_dep'])
                $outgoing_flight->where("arrive_date", $date_before_match)
                                ->whereIn("to", $airports_in_city)
                                ->whereIn("from", $req_airports);
                if ($date_before_match ==  $match_date) {
                    $outgoing_flight->where("arrive_time", "<=", $time_before_match);
                }
//                $return_flight->where("arrive_date", $cart_flight['date_flight_arr'])
                $return_flight->where("arrive_date", $match_end_date)
                                ->whereIn("from", $airports_in_city)
                                ->whereIn("to", $req_airports);
                if ($cart_flight['date_flight_arr'] == $match_end_date) {
                    $return_flight->where("departure_time", ">=", $time_after_match);
                }
            } else {
                    $outgoing_flight->where("arrive_date", $cart_flight['date_flight_dep'])
                                ->whereIn("to", $airports_in_city)
                                ->whereIn("from", $req_airports);
                if ($cart_flight['date_flight_dep'] ==  $match_date) {
                    $outgoing_flight->where("arrive_time", "<=", $time_before_match);
                } 
                $return_flight->where("arrive_date", $cart_flight['date_flight_arr'])
                                ->whereIn("from", $airports_in_city)
                                ->whereIn("to", $req_airports);
                if ($cart_flight['date_flight_arr'] == $match_end_date) {
                    $return_flight->where("departure_time", ">=", $time_after_match);
                }
            }
        }

        if ($outgoing_flight != 'Wrong date') {
            $out_flights = $outgoing_flight->get();
        }

        if ($return_flight != 'Wrong date') {
            $ret_flights = $return_flight->get();
        }

        $out_flights_first      = $outgoing_flight->first();
        $ret_flights_first      = $return_flight->first();

        $response['out_count']  = count($out_flights);
        $response['to_count']   = count($ret_flights);
//var_dump($request->all());
        $from_flight_data   =   '<div class="product-title">'.Translater::getValue("from-title-outgoing-flight").' 
                                    <a class="btn btn-default day-earl" name="earl_day_outfliy" id="earl_day_outfliy">'.Translater::getValue("form-label-day-earlier").'</a>';
                                    if ($out_flights_first->departure_date == $match_date) {
                                        $from_flight_data .= '<span id="date_now_in_form" style="margin-right: 10px">' . date('d-m-Y', strtotime($out_flights_first->departure_date)) . '</span>';
                                    } else {
                                        $from_flight_data .=    '<span id="date_now_in_form">' . date('d-m-Y', strtotime($out_flights_first->departure_date)) . '</span>';
                                        if (($match->fixed_data == 0) && ($match_date == date('Y-m-d', strtotime($request->input('day_form_out') . ' + 1 day'))) && $request->input("button_direction") == 'latt_day_outfliy') {
                                           //need to hide button
                                        } else {
                                            $from_flight_data .= '<a class="btn btn-default day-latter" name="latt_day_outfliy" id="latt_day_outfliy">'.Translater::getValue("form-label-day-later").'</a>';
                                        }
                                    }
        $from_flight_data   .=  '</div>
                                 <table class="table table-bordered" cellspacing="5" cellpadding="5" >
                                    <tr>
                                        <th class="num-check"> </th>';
                                    if ($request->input('screen_size') > 370) {
                                        $from_flight_data   .= '<th>'.Translater::getValue("title-airline").'</th>';
                                    }
        $from_flight_data   .= '<th class="td-data">'.Translater::getValue("form-label-from").'</th>
                                <th class="td-data">'.Translater::getValue("form-label-to").'</th>
                                <th class="td-data">'.Translater::getValue("form-label-time").'</th>
                                <th class="td-data">'.Translater::getValue("label-price").'
                                    <span class="glyphicon '.(($request->input("sortorder") == "desc" and $request->input("sorttype")=="outprice")? 'glyphicon-triangle-top':'glyphicon-triangle-bottom').'" id="outsort" style="cursor:pointer;"></span>
                                    </th>
                            </tr>
                            <tbody >';
        $from_flights_selected = 'checked';

        foreach ($out_flights as $key=>$flight) {
            $departureDateTime  = Carbon::parse($flight->departure_date.' '.$flight->departure_time);

            $from_flight_data       .= '<tr '.(($flight->id == $cart_flight['dept_flight'])?'class="checktddepart"':"").' name="dept_flight_td">
                                        <td class="num-check"> 
                                            <input class="hide" type="checkbox" '.(($flight->id == $cart_flight['dept_flight'])?'checked="checked"':"").' name="dept_flight" value="'.$flight->id.'"></td>';
            if ($request->input('screen_size') > 370) {
                $from_flight_data   .= '<td>' . ucwords($flight->airline->name) . '</td>';
            }
            $from_flight_data       .= '<td class="td-data">'.$flight->source_airport->title.'</td>
                                        <td class="td-data">'.$flight->destination_airport->title.'</td>
                                        <td class="td-data">'.$departureDateTime->format('H:i').'</td>
                                        <td class="td-data">'.(number_format(addAdditionalPrice($flight->price) - $out_min_price, 2) >= 0 ? '+' : '-').' '.abs(number_format(addAdditionalPrice($flight->price) - $out_min_price, 2)).' p.p.
                                    </td>
                                </tr>';
            $from_flights_selected = '';
        }
        $from_flight_data       .=  '</tbody></table>';
        $return_flight_data     =   '<div class="product-title">'.Translater::getValue("form-title-return-flight");
                                    if ($ret_flights_first->departure_date == $match_end_date) {
                                        $return_flight_data .= '<span id="date_now_in_form_return" style="margin-left: 10px">'.date('d-m-Y',strtotime($ret_flights_first->departure_date)).'</span>';
                                    } else {
                                        $return_flight_data .= '<a class="btn btn-default day-earl" name="earl_day_return" id="earl_day_return">' . Translater::getValue("form-label-day-earlier") . '</a>
                                                                <span id="date_now_in_form_return">'.date('d-m-Y',strtotime($ret_flights_first->departure_date)).'</span>';
                                    }
        $return_flight_data     .= '<a class="btn btn-default day-latter" name="latt_day_return" id="latt_day_return">'.Translater::getValue("form-label-day-later").'</a>
                                    </div>
                                    <table class="table table-bordered" cellspacing="5" cellpadding="5" >
                                        <tr>
                                            <th class="num-check"> </th>';
        if ($request->input('screen_size') > 370) {
            $return_flight_data .= '<th>'.Translater::getValue("title-airline").'</th>';
        }
        $return_flight_data     .= '<th class="td-data">'.Translater::getValue("form-label-from").'</th>
                                    <th class="td-data">'.Translater::getValue("form-label-to").'</th>
                                    <th class="td-data">'.Translater::getValue("form-label-time").'</th>
                                    <th class="td-data">'.Translater::getValue("label-price").'<span class="glyphicon '.(($request->input("sortorder") == "desc" and $request->input("sorttype")=="returnprice")? 'glyphicon-triangle-top':'glyphicon-triangle-bottom').'" id="returnsort" style="cursor:pointer;"></span></th>
                                </tr>
                            <tbody >';
        $ret_flights_selected = 'checked';

        foreach ($ret_flights as $key=>$flight) {
            $departureDateTime      = Carbon::parse($flight->departure_date.' '.$flight->departure_time);

            $return_flight_data         .= '<tr '.(($flight->id == $cart_flight['return_flight'])?'class="checktdrett"':"").' name="return_flight_td">  
                                            <td class="num-check">
                                                <input class="hide" '.(($flight->id == $cart_flight['return_flight'])?'checked="checked"':"").' type="checkbox" name="return_flight" value="'.$flight->id.'">
                                            </td>';
            if ($request->input('screen_size') > 370) {
                $return_flight_data     .= '<td class="td-data">'.ucwords($flight->airline->name).'</td>';
            }
            $return_flight_data         .= '<td class="td-data">'.$flight->source_airport->title.'</td>
                                            <td class="td-data">'.$flight->destination_airport->title.'</td>
                                            <td class="td-data">'.$departureDateTime->format('H:i').'</td>
                                            <td class="td-data">'.(number_format(addAdditionalPrice($flight->price) - $ret_min_price, 2) >= 0 ? '+' : '-').' '.abs(number_format(addAdditionalPrice($flight->price) - $ret_min_price, 2)).' p.p.</td>
                                        </tr>';
            $ret_flights_selected   = '';
        }
        $return_flight_data         .='</tbody> </table>';
        $response['return_flight']  = $return_flight_data;
        $response['from_flight']    = $from_flight_data;

        return response()->json($response);
    }

    public function showRoomForMatch($match_id, Request $request) {
        if (!$request->session()->has("cart_match") or !$request->session()->has("cart_flight")) {
            return redirect(url());
        }

        $flights       = $request->session()->get("cart_flight");
        $dept_flight   = Flight::find($flights['dept_flight']);
        $return_flight = Flight::find($flights['return_flight']);
        $date1         = new DateTime($return_flight->departure_date);
        $date2         = new DateTime($dept_flight->arrive_date);

        /*
          below code returns the difference between two DateTime objects
        */
        $interval      = $date1->diff($date2);
//        $days_book     = $interval->d + 1;
        $days_book     = $interval->d; // Booking days is equal to the difference of flight dates
        $match         = Match::find($match_id);
        $accomodations = Accomodation::with('getOptions')->with('images')->where("city", "=",$match->getStadium->city)
                            ->orderBy('low_season_prices', 'asc')
                            ->get();

        $cart_hotel = $request->session()->get("cart_room");
        return view("voetbaltrips_frontend.accomodation", [
            "match"         => $match,
            "match_id"      => $match_id,
            "accomodations" => $accomodations,
            "days_needed"   => $days_book,
            "cart_hotel"    => $cart_hotel
        ]);
    }
    public function bookRoomForMatch($match_id, Request $request) {
        $response['status']  = "error";
        $response['message'] = "You must select a hotel to continue the order.";
        $rules = [
            "accomo"    => "required",
            "room_days" => "required"
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->passes()) {
            $accomo              = Accomodation::find($request->input("accomo"))->with('images');
            $cart_array = [
                "name"              => $accomo->name,
                "price"             => addAdditionalPrice($accomo->low_season_prices),
                "accomo_id"         => $request->input("accomo"),
                "include_breakfast" => $request->input("include_breakfast"),
                "room_days"         => $request->input("room_days")
            ];
            if($request->input("include_breakfast") == "on") {
                $cart_array['breakfast_price'] = addAdditionalPrice($accomo->breakfast_price);
            }
            $request->session()->set("cart_room", $cart_array);
            $response['nextpage'] = url("match/".$match_id."/extras");
            if($request->input("edit") == "yes") {
                $response['nextpage'] = url("cart/summary");
            }
            $response['status'] = "success";
        }
        return response()->json($response);
    }
    public function cartSummary(Request $request) {
        $total      = 0;
        $home_team  = [];
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']      = $request->session()->get('cart_match');
            $cart_data['quantity']      = $request->session()->get('cart_quantity');
            $cart_data['match_data']    = $request->session()->get('match_data');
            $total                      = ($total + ($cart_data['match_data']['price'] * $cart_data['quantity']));
        }
        $m = Match::find($cart_data['match_id']);
        $mass_home_team = [5,6,13,18];
        if (in_array($m->home_club, $mass_home_team)) {
            $home_team['text'] = Translater::getValue('form-question-may-be-sent-to-your-home');
            $home_team['title'] = Translater::getValue('form-label-information');
            Session::set('ticketstohome', 1);
        }
        if ($request->session()->has('cart_flight')) {
            $flight_array               = $request->session()->get("cart_flight");
            $dept                       = Flight::find($flight_array['dept_flight']);
            $return                     = Flight::find($flight_array['return_flight']);
            $cart_data['dept_flight']   = $dept;
            $cart_data['return_flight'] = $return;
            $total                      = ($total + (addAdditionalPrice($dept->price) *$cart_data['quantity']) + (addAdditionalPrice($return->price) * $cart_data['quantity']));
        }
        if ($request->session()->has("cart_room")) {
            $room_array                 = $request->session()->get("cart_room");
            $cart_data['room']          = $room = $room_array;
            $room_total                 = ($room_array['price']*$cart_data['quantity']);
            if($room['include_breakfast'] == "on") {
                $room_total = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
            }
            $total = ($total + ($room_total * $room_array['room_days']));
        }
//        dd($request->session()->get("cart_options"));
        if ($request->session()->has("cart_options")) {
            $cart_options         = $request->session()->get("cart_options");
            $cart_data['options'] = $cart_options;
            $opt_tot              = 0;
            foreach ($cart_options as $opt) {
                $opt_tot = ($opt_tot + ($opt['cost']));
            }
            $total = ($total+$opt_tot);
        }
        $cart_data['total_amount']  = $total;
        $travel_info                = $request->session()->get('travelinfo');
        if ($request->session()->has("only_ticket")) {
            $onlylyTicket = true;
        } else {
            $onlylyTicket = false;
        }
        return view("voetbaltrips_frontend.cartsummary", compact('cart_data', 'travel_info', 'onlylyTicket', 'home_team'));
    }
    
    public function couponCheckCode(Request $request)
    {
        $response['status'] = 'success';            
        
        if ($request->coupon_code == null) {
            return;
        }
        
        $coupon = Discount::where('is_used', 0)
                ->where('code', $request->coupon_code)
                ->first();
        
        if ($coupon) {
            $response['coupon'] = 'valid';
            $response['message'] = Translater::getValue('coupon_code_valid');
        } else {
            $response['coupon'] = 'not_valid';
            $response['message'] = Translater::getValue('coupon_code_wrong');
        }
        
        return response()->json($response);
    }

    /**
     *
     * Add the departure and return flight to the session
     *
     * The quantity will be select from the first page
     *
     *
     * @param $match_id
     * @param Request $request
     * @return array
     */
    public function bookFlightForMatch($match_id, Request $request) {

        $response['status']   = "error";
        $response['message']  = "There Should select departure and return flights";
        $rules = [
            "dept_flight"   => "required",
            "return_flight" => "required"
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->valid()) {

            $out                = Flight::findOrFail($request->input("dept_flight"));
            $return             = Flight::findOrFail($request->input("return_flight"));
            $date_flight_dep = new DateTime($out->departure_date);
            $date_flight_arr = new DateTime($return->departure_date);

            $date1              = new DateTime($return->departure_date);
            $date2              = new DateTime($out->arrive_date);
            $interval           = $date1->diff($date2);

            $flight_array = [
                "name"          => "Flight Ticket",
                "dept_flight"   => $request->input("dept_flight"),
                "return_flight" => $request->input("return_flight"),
                "date_flight_dep"   => $date_flight_dep,
                "date_flight_arr"   => $date_flight_arr
            ];
            $request->session()->set("cart_flight", $flight_array);

            $days_book     = $interval->d; // Booking days is equal to the difference of flight dates
            $hotel              = $request->session()->get("cart_room");
            $hotel['room_days'] = $days_book;
            $request->session()->set("cart_room", $hotel);
            $response['status']   = "success";
            $response['nextpage'] = url("match/".$match_id."/accomodation");
            if($request->input("edit") == "yes") {
                $response['nextpage'] = url("cart/summary");
            }
        }
        return response()->json($response);
    }

    /**
     * This function is used to remove the all cart contents
     */
    public function resetCart(Request $request) {
        $request->session()->forget("cart_match");
        $request->session()->forget("match_data");
        $request->session()->forget("cart_quantity");
        $request->session()->forget("cart_flight");
        $request->session()->forget("cart_room");
        $request->session()->forget("travelinfo");
        $request->session()->forget("cart_options");
        $request->session()->forget("show");

        if ($request->session()->has('ticketstohome')) {
            $request->session()->forget("ticketstohome");
        }

        if ($request->session()->get('only_ticket')) {
            $request->session()->forget("only_ticket");
            $resp['only_ticket'] = true;
        }

        $resp['status']  = "success";
        $resp['message'] = "Cart items removed Successfully.";

        return response()->json($resp);
    }
    /**
     * This function is used tp check whether the user is loggedin or not
     * If the user is already checked in then go to payment page
     * If the user is not logged in then go to login page
     * If the user is not registered then make the user to login and then redirect to payment confirm page
     *
     */
    public function checkProceedtoPayment() {
        if(Sentinel::check()) {
            return redirect(url("cart/payment"));
        }
        //return redirect(url("login"));
        return redirect(url("register"));
    }
    public function checkItemExistInCart($type = null) {
        $resp = array("status"=>"success");
        $opt = array_column(Cart::content()->toArray(), 'options');
        foreach ($opt as $value) {
            if($value->type == $type) {
                $resp['status']      = "error";
                $resp['message'] = "You can select only one ".$type." at a time";
                return $resp;
            }
        }
    }
    //TODO travellerinfo
    public function travellerinfo($match_id = NULL, Request $request) {

        if(!$request->session()->has("cart_match")){
            return redirect(url());
        }
        $total   = $request->session()->get("cart_quantity");
        $match   = Match::find($match_id);
        $country = Country::lists("name", "name");
        $travelinfo = $request->session()->get("travelinfo");

        return view("voetbaltrips_frontend.travellerinfo", compact('match', 'match_id', 'country', 'total', 'travelinfo' ));
    }

    /**
     * From this moment for two request : match and tickets
     */

    public function saveTravellerInformation($match_id, Request $request) {

        if(!$request->session()->has("cart_match")) {
            return redirect(url());
        }

        $this->validate($request, [
            "traveller_first_name"  => "required",
            "traveller_last_name"   => "required",
            "dob"                   => "required",
            "gender"                => "required",
            "traveller_phone"       => "required",
            "traveller_country"     => "required",
            "traveller_city"        => "required"
        ]);

        $travellerName = [];
        $travellerFirstName = $request->input('traveller_first_name');
        $travellerLastName = $request->input('traveller_last_name');

        for ($i = 0; $i < count($travellerFirstName); $i++) {
            $travellerName[] = $travellerFirstName[$i] .' '. $travellerLastName[$i];
        }

        $data  = $request->all();
        unset($data['_token']);

        $data['traveller_name'] = $travellerName; // Adding traveller name

        $request->session()->put('travelinfo', $data);

        return redirect("cart/summary");
    }

    /**
     *
     * Showing the cart popup data
     *
     * @return View
     */
    public function showCartPopup(Request $request) {
        $total = 0;
        $cart_data['match_id']        = '';
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']    = $request->session()->get('cart_match');
            $cart_data['quantity']    = $request->session()->get('cart_quantity');
            $cart_data['match_data']  = $request->session()->get('match_data');
            $total                    = ($total + ($cart_data['match_data']['price']*$cart_data['quantity']));
        }
        if ($request->session()->has('cart_flight')) {
            $flight_array = $request->session()->get("cart_flight");
            $dept                       = Flight::find($flight_array['dept_flight']);
            $return                     = Flight::find($flight_array['return_flight']);
            $cart_data['dept_flight']   = $dept;
            $cart_data['return_flight'] = $return;
            $total = ($total + (addAdditionalPrice($dept->price) *$cart_data['quantity']) + (addAdditionalPrice($return->price) * $cart_data['quantity']));
        }
        if($request->session()->has("cart_room")) {
            $room_array        = $request->session()->get("cart_room");
            $cart_data['room'] = $room_array;
            $room_total                 = ($room_array['price']*$cart_data['quantity']);
            if($room_array['include_breakfast'] == "on") {
                $room_total = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
            }
            $total = ($total+($room_total * $room_array['room_days']));
        }
        if($request->session()->has("cart_options")) {
            $cart_options         = $request->session()->get("cart_options");
            $opt_tot              = 0;
            $cart_data['options'] = $cart_options;
            foreach ($cart_options as $opt) {
                $opt_tot = ($opt_tot + ($opt['price'] * $opt['qty']));
            }
            $total = ($total+$opt_tot);
        }
        $cart_data['total']         = $total;
        return View("voetbaltrips_frontend.cartpopup", $cart_data);
    }

    /**
     * In this page shows the options added in the admin panel
     * This is not a mandatory
     * If the user do not want to add items in the options then he can skip
     * @param $match_id
     * @param Request $request
     * @return Redirect|View
     */
    public function showExtras($match_id, Request $request) {
        if(!$request->session()->has("cart_match")) {
            return redirect(url());
        }
        $cartshow = "no";
        $cart_options = [];
        if($request->session()->has("cart_options")) {
            $cartshow     = "yes";
            $cart_options = $request->session()->get("cart_options");
        }
        $match   = Match::findorFail($match_id);
        $options = Option::get();
        $quantity = $request->session()->get('cart_quantity');
//        dd();

        return View('voetbaltrips_frontend.options', [
            "match"        => $match,
            "options"      => $options,
            "match_id"     => $match_id,
            "cart_show"    => $cartshow,
            "quantity"     => $quantity,
            "cart_options" => $cart_options
        ]);
    }

    /**
     * This function used to save the options to cart.
     * @param Request $request
     * @return mixed
     */
    public function addOptionsToCart(Request $request) {
        $response['status']  = "error";
        $response['message'] = Translater::getValue('modal-message-something-went-wrong');
        $rules = [
            "cost"     => "required",
            "identity" => "required"
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->passes()) {
            $opt = Option::findorFail($request->input("identity"));
            $response['message'] = Translater::getValue('modal-message-you-have-successfully-added') ." ".$opt->title."  ". Translater::getValue('modal-message-to-the-cart');
            if($request->session()->has("cart_options")) {
                /**
                 * here check that the item is already exist in the cart
                 * if the item is exist in the cart then the quantity will be updated
                 * otherwise it will be added to the cart
                 */
                $cart       = $request->session()->get("cart_options");
                $check_cart = array_search($request->input("identity"), array_column($cart, 'opt_id'));
                if($check_cart === false) {
                    $cart[] = [
                        "name"   => $opt->title,
                        "price"  => addAdditionalPrice($opt->price),
                        "opt_id" => $request->input("identity"),
                        "cost"    => $request->input("cost"),
                    ];
                } else {
                    /**
                     * The cart item is exist
                     */
                    $cart[$check_cart]['cost'] = $request->input("cost");
                    $response['message'] = Translater::getValue('modal-message-you-have-successfully-updated') ." ".$opt->title." ". Translater::getValue('modal-message-cart-quantity');

                }
                $request->session()->put("cart_options", $cart);
            } else {
                $cart_array[] = [
                    "name"   => $opt->title,
                    "price"  => addAdditionalPrice($opt->price),
                    "opt_id" => $request->input("identity"),
                    "cost"    => $request->input("cost"),
                ];
                $request->session()->put("cart_options", $cart_array);
            }
            $response['status']  = "success";
            $response['status_translate']  = Translater::getValue('modal-title-success');
        }
        return response()->json($response);
    }
    public function removeOptionsFromCart(Request $request) {
        $response['status']  = "error";
        $cart                = $request->session()->get("cart_options");
        $check_cart          = array_search($request->input("identity"), array_column($cart, 'opt_id'));
        $opt = Option::findOrFail($request->input("identity"));
        if($check_cart === false) {
            $response['message'] = "Unable to remove from Cart!!!";
        } else {
            $cart     = $request->session()->get("cart_options");
            unset($cart[$check_cart]);
            $request->session()->put("cart_options", array_values($cart));
            $response['status']  = "success";
            $response['status_translate']  = Translater::getValue('modal-title-success');

            $response['message'] = Translater::getValue('title-options') ." ".$opt->title." ". Translater::getValue('modal-message-removed-from-the-cart-successfully');
        }
        return response()->json($response);
    }
    public function downloadFiles($type, $file_name) {
        ob_clean();
        $file    = base_path("public/uploads/{$type}/".$file_name);
        $mime    = File::mimeType($file);
        $headers = array(
            'Content-Description: File Transfer',
            'Content-Type: '.$mime,
            'Content-Disposition: attachment; filename="'.basename($file).'"',
            'Expires: 0',
            'Cache-Control: must-revalidate',
            'Pragma: public',
            'Content-Length: ' . filesize($file)
        );
       return response()->download($file, $file_name, $headers);
    }

    /**
     * @param Request $request
     * Retrieve the hotel details
     */
    public function getHotelDetails(Request $request) {

        $resp['status'] = "error";
        $acc_id         = $request->input("accomo");
        $accomodations  = Accomodation::findorFail($acc_id);
        $hotel          = $request->session()->get("cart_room");
        $cart_array = [
            "name"              => $accomodations->name,
            "price"             => addAdditionalPrice($accomodations->low_season_prices),
            "accomo_id"         => $request->input("accomo"),
            "include_breakfast" => $request->input("include_breakfast"),
            "room_days"         => $hotel["room_days"]
        ];

        if($request->input("include_breakfast") == "on") {
            $cart_array['breakfast_price'] = addAdditionalPrice($accomodations->breakfast_price);
        }
        $request->session()->set("cart_room", $cart_array);
        $data = '';

        if(isset($accomodations->id)) {
            $images = AccomodationImages::where('accomodation_id',$accomodations->id)->get();
                foreach($images as $key => $image) {
                    $data .= '<div class="col-md-6 col-md-offset-0"><img src="'.((File::exists(base_path()."/public/uploads/hotel/".$image->image) == true) ? url("uploads/hotel/".$image->image): url("assets/img/no-image-available.png")).'"><div class="product-description"><p>'.$accomodations->description.'</p></div></div><div class="col-md-6 col-md-offset-0"><h4>Address</h4><p>'.$accomodations->address.',&nbsp;'.$accomodations->cityobj->name.',&nbsp;'.$accomodations->country->name.'</p><input id="rating-system" type="number" class="rating-loading" data-min="0" data-max="5" data-step="1" value="'.$accomodations->stars.'" name="stars"/>';
                }
            }

        if($accomodations->options) {
            $data = $data.'<h4>Facilities</h4>';
            $ac_opt = explode(",",$accomodations->options);
            foreach ($ac_opt as $opt_value) {
                $data = $data.'<p>- &nbsp;'.$opt_value.'</p>';
                }
            }
        $data                    = $data.'</div>';
        $resp['status']          = "success";
        $resp['message']         = "Accommodation details changed";
        $resp['data']            = $data;
        $resp['breakfast_price'] = addAdditionalPrice($accomodations->breakfast_price);

        return response()->json($resp);
    }

    /**
     * This script is used to show total price selected from the cart.
     */
    //TODO
    public function getCartTotalPrice(Request $request) {

        $total = 0;
        $subtotal = 0;
        $response['total'] = "";
        /**
         * take price of match ticket
         */
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']    = $request->session()->get('cart_match');
            $cart_data['quantity']    = $request->session()->get('cart_quantity');
            $cart_data['match_data']  = $request->session()->get('match_data');

            $total                    = ($total + (($cart_data['match_data']['price'])*$cart_data['quantity']));
            $subtotal = addAdditionalPrice($cart_data['match_data']['price']);

            $for_cart_string = $cart_data['match_data']['for_cart'];
        }

        /**
         * $subtotal = 80
         */
        if ($request->session()->has('cart_flight')) {
            $flight_array               = $request->session()->get("cart_flight");

            $dept                       = Flight::find($flight_array['dept_flight']);
            $return                     = Flight::find($flight_array['return_flight']);
            $cart_data['dept_flight']   = $dept;
            $cart_data['return_flight'] = $return;
            $total                      = ($total + (addAdditionalPrice($dept->price) *$cart_data['quantity']) + (addAdditionalPrice($return->price) * $cart_data['quantity']));
            $subtotal = ($subtotal + (addAdditionalPrice($dept->price) + addAdditionalPrice($return->price)));
        }

        /**
        * $subtotal = 105
        */

        if ($request->session()->has("cart_room")) {
            $room_array        = $request->session()->get("cart_room");
            $cart_data['room'] = $room_array;
            $room_sub_price    = $room_array['price'];
            $room_total        = ($room_array['price']*$cart_data['quantity']);

            if ($room_array['include_breakfast'] == "on") {
                $room_total     = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
                $room_sub_price = $room_sub_price + $room_array['breakfast_price'];
            }

            $total      = ($total+($room_total * $room_array['room_days']));
            $subtotal   = ($subtotal + ($room_sub_price * $room_array['room_days']));
        }
        $opt_tot = 0;

        if ($request->session()->has("cart_options")) {
            $cart_options         = $request->session()->get("cart_options");
            $cart_data['options'] = $cart_options;
            foreach ($cart_options as $opt) {
                $opt_tot = ($opt_tot + ($opt['cost']));
            }
            $total = ($total+$opt_tot);
        }


        //really dont know how to make breadchumbs in this fckn architecture
        $cartClass = $request->className;


        if (! $request->session()->get('only_ticket') && $cartClass != null) {
            $breadchumbs = "<ul>";
            $breads = [];
            //TODO: rename all with translating like Translater::getValue('label-shopping-cart')
            //but need to add translations very first
            $breads['cart_match']           = 'Match';
            $breads['cart_flightselection'] = 'Flight';
            $breads['cart_roomselection']   = 'Accomodation';
            $breads['cart_extras']          = 'Extras';
            $breads['cart_travellerinfo']   = 'Traveler Info';
            $breads['cart_cartsummary']     = 'Summary';
            foreach ($breads as $key => $bread) {
                if ($key == $cartClass) {
                    $breadchumbs .= "<li class='active'>$bread</li>";
                } else {
                    $breadchumbs .= "<li>$bread</li>";
                }
            }
            $breadchumbs .= "</ul>";
        } else {
            $breadchumbs = "";
        }

        $packageInfo = "";
        if (! $request->session()->has('only_ticket')) {
            try {
                $packageInfo .= "<div class='col-sm-4'>" .
                    "<span>" . Translater::getValue('cart-departure-flight') . ": {$cart_data['dept_flight']->departure_time} {$cart_data['dept_flight']->departure_date}</span><br />" .
                    "<span>" . Translater::getValue('cart-return-flight') . ": {$cart_data['return_flight']->arrive_time} {$cart_data['return_flight']->arrive_date}</span>";
                $packageInfo .= "</div>";

                $ticketsCategory = preg_match('/([^\)]+)\((.*)\)/', $cart_data['match_data']['name'], $ticketMatched);
                $ticketsCategory = $ticketMatched[2];

                $packageInfo .= "<div class='col-sm-4'>" .
                    "<span>" . Translater::getValue('cart-tickets-category') . ": {$ticketsCategory}</span><br />" .
                    "<span>" . Translater::getValue('cart-hotel-name') . ": {$cart_data['room']['name']}</span>";
                $packageInfo .= "</div>";
            } catch (Exception $e) {

            }
        }

        $subtotalPPP = addAdditionalPrice($subtotal) + ($opt_tot > 0 ? $opt_tot / $cart_data['quantity'] : 0);

        $packageInfo .= "<div class='col-sm-4'>".
            "<span>".Translater::getValue('cart-ppp').": &euro;".$subtotalPPP."</span><br />".
            "<span class='total-price'>".Translater::getValue('cart-total-price').": &euro;".(($cart_data['quantity']*$subtotal)+$opt_tot)."</span>";
        $packageInfo .= "</div>";

        if ($subtotal > 0) {
            $response['total'] = "<div class='row text-center'>".
                                 "<div class='breadchumbs'>".
                                    $breadchumbs.
                                 "</div>".
                                 "<div class='container'>".
                                 //"<label class='winkel_name_cart'>".Translater::getValue('label-shopping-cart')."</label>".
                                 "<label class='cart_teams'>$for_cart_string</label>".
                                 "<span class='text-center' id='package_show'>".
//                                 "<span class='cart_item'>".$cart_data['quantity']." x &euro;".addAdditionalPrice($subtotal). (($opt_tot>0)?" + &euro;$opt_tot":"")." = &euro;".(($cart_data['quantity']*$subtotal)+$opt_tot). "</span>".
                                 "<button class='btn btn-success' id='resetcart'>". Translater::getValue('button-empty-cart') ."</button></span></div>".
                                 "<div class='container cart-package-info'>".
                                    $packageInfo.
                                 "</div>";
        }

//        if ($subtotal > 0) {
//            $response['total'] = "<div class='row text-center'>".
//                "<div class='container'>".
//                //"<label class='winkel_name_cart'>".Translater::getValue('label-shopping-cart')."</label>".
//                "<label class='cart_teams'>$for_cart_string</label>".
//                "<span class='text-center' id='package_show'>".
//                "<span class='cart_item'>".$cart_data['quantity']." x &euro;".addAdditionalPrice($subtotal). (($opt_tot>0)?" + &euro;$opt_tot":"")." = &euro;".(($cart_data['quantity']*$subtotal)+$opt_tot). "</span><button class='btn btn-success' id='resetcart'>". Translater::getValue('button-empty-cart') ."</button></span></div>";
//        }

        return response()->json($response);
    }

    public function checkEverythingBeforeConfirmCart(Request $request)
    {
        $response['status']  = "error";
        $response['message'] = "Unable to complete the cart";
        $cart_qty            = $request->session()->get("cart_quantity");
        $request->session()->set("coupon_code", $request->coupon_code);

        if ($request->session()->get('only_ticket')) {
            $count_travellers = $cart_qty;
        } else {
            $travelinfo          = $request->session()->get("travelinfo");
            $count_travellers    = count($travelinfo['traveller_name']);
        }

        if($cart_qty == $count_travellers) {
            $response['status']  = "success";
            $response['message'] = "Cart validation success";
        } else {
            $response['message'] = "Please fill the traveller information before you proceed.";
        }
        return response()->json($response);
    }
}
