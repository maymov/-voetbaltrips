<?php
namespace App\Http\Controllers;
use Activation;
use App\Accomodation;
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
use App\User;
use Carbon\Carbon;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
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
class VoetbaltripsFrontendController_bakup extends JoshController
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
        $city           = Cities::orderBy("name", "asc")->get();
        $tournaments    = Tournament::where("end_date",">=", date("Y-m-d"))->orderBy("name", "asc")->get();
        $ajaxload_match = "no";
        $matches        = [];
        if($request->has("city")) {
            $city_uri = urldecode(trim($request->input("city")));
            $ajaxload_match = "yes";
        }
        if($request->has("club")) {
            $club_uri = urldecode(trim($request->input("club")));
            $ajaxload_match = "yes";
        }
        if($request->has("tournament")) {
            $tournament_uri = urldecode(trim($request->input("tournament")));
            $ajaxload_match = "yes";
        }

        /*$getmatch    = Match::where("match_date", ">=", date('Y-m-d H:i:s'));
        if(!empty($city_uri)) {
            $getmatch->whereHas('getStadium', function($q) use($city_uri) {
                $q->whereHas('cities', function($c) use($city_uri){
                    $c->where("name", "=", $city_uri);
                });
            });
        }
        if(!empty($tournament_uri)) {
            $getmatch->whereHas("getTournament", function($q) use($tournament_uri) {
                $q->where("name", "=", $tournament_uri);
            });
        }
        if(!empty($club_uri)) {
            $getmatch->whereHas("getHomeClub", function($q) use($club_uri) {
                $q->where("name", "=", $club_uri);
            })
            ->orWhereHas('getAwayClub', function($q) use($club_uri) {
                $q->where("name", "=", $club_uri);
            });
        }
        $getmatch->orderby("match_date", "asc");
        if(!empty($city_uri) or !empty($club_uri) or !empty($tournament_uri)){
            $matches     = $getmatch->get();
        }*/
        return View::make('voetbaltrips_frontend.index', compact('club', 'city', 'tournaments', 'city_uri', 'club_uri', 'tournament_uri', 'matches', 'ajaxload_match'));
    }

    /**
     *
     * When the user change the city then there also need to show the matches held in the specific city
     *
     * @param $city
     * @return mixed
     */
    private function getAjaxClubs($city) {
        $clubs            = Club::where('city','=', $city)->get();
        return $clubs;

    }
    public function getAjaxCities(Request $request){
        $cities = Cities::where("country_id", "=", $request->input("country_id"))->select("name", "id")->get();
        return response()->json(array("cities"=>$cities));
    }

    /**
     *
     */
    public function getImagesFromStorage($category, $filename) {
        $exists = File::exists(base_path()."/public/uploads/".$category.'/'.$filename);
        if ($exists) {
            $file = base_path()."/public/uploads/".$category.'/'.$filename;
            $mimetype = File::mimeType($file);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $mimetype);
            return $response;
        }

        /* return (new Response($file, 200))
             ->header('Content-Type', $mimetype);*/
    }




    public function getAjaxMatches(Request $request) {
    
        if($request->input("loadclub") == "yes") {
            $resp['clubs'] = $this->getAjaxClubs($request->input("city"));
        }
        $getmatch = Match::where("match_date", ">=", date('Y-m-d H:i:s'));
        if(!empty($request->input("tournament"))) {
            $getmatch->where("tournament", "=", $request->input("tournament"));
        }
        if(!empty($request->input("club"))) {
            $getmatch->where("home_club", "=", $request->input("club"));
            $getmatch->orWhere("away_club", "=", $request->input("club"));
        }
        if(!empty($request->input("city"))) {
            $city = $request->input("city");
            $getmatch->whereHas('getStadium', function($q) use($city) {
                $q->where('city', '=', $city);
            });
        }
        if(!empty($request->input("match_date"))){
            $getmatch->whereDate("match_date", "=", $request->input("match_date"));
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
            $q->whereHas('getNearestAirport', function ($qa) {
                $qa->whereHas("flightTo", function ($qb){
                    $qb->where("arrive_date", "<=", DB::raw("DATE_FORMAT(matches.`match_date`, '%Y-%m-%d')"));
                    $qb->where("flightmode", "=", 1);
                    $qb->where("departure_date", ">=", date("Y-m-d"));
                });
            });
        });
        /**
         * if there is enough flights between two days after the match can be shown
         */
        $getmatch->whereHas('getStadium', function($q) {
            $q->whereHas('getNearestAirport', function ($qa) {
                $qa->whereHas("flightFrom", function ($qb) {
                    $qb->whereRaw(DB::raw("departure_date between DATE_FORMAT(DATE_ADD(matches.`match_date`,INTERVAL 1 DAY), '%Y-%m-%d') and DATE_FORMAT(DATE_ADD(matches.`match_date`,INTERVAL 2 DAY), '%Y-%m-%d')"));
                    $qb->where("flightmode", "=", 2);
                    $qb->where("departure_date", ">=", date("Y-m-d"));
                });
            });
        });
        /**
         *
         * Check that any hotel is added to the city
         *
         */
        $getmatch->whereHas('getStadium', function($q){
            $q->whereHas('cities', function ($qa) {
                $qa->whereHas("accomodation", function ($qb){
                    $qb->where("created_at", "!=", "NULL");
                });
            });
        });

        /**
         * To check that tournament is ended or not
         */
        $getmatch->whereHas("getTournament", function ($q){
            $q->where("end_date", ">=", date("Y-m-d"));
        });
        $getmatch->orderby("match_date", "asc");
        $match_result     = $getmatch->get();
        $match            = array();

        foreach($match_result as $key=>$val) {
            if(empty($val->competitionSeatingGet->min('price'))){
                break;
            }
            $match_date       = $val->match_date;
            $date1            = strtotime($match_date);
            $date2            = date("l", $date1);
            $weekday          = strtolower($date2);
            $prev_date        = date('Y-m-d', strtotime($match_date .' -1 day'));
            $next_date        = date('Y-m-d', strtotime($match_date .' +2 day'));
            $prev_time        = date('H:i:s', strtotime($match_date .' -1 day'));
            $match_tomorow    = date('Y-m-d', strtotime($match_date .' +1 day'));
            $outflight = $val->getStadium->getNearestAirport->flightTo()
                ->where("flightmode", "=", 1)
                ->where("departure_date", ">=", date("Y-m-d"));
            if($weekday == "sunday" or $weekday == "saturday") {
                $prev_date = date('Y-m-d', strtotime($match_date) - 60 * 60 * 6);
                $prev_time = date("H:i:s", strtotime($match_date) - 60 * 60 * 6);
                $date      = new DateTime($match_date);
                $date->modify('next monday');
                $next_date = $date->format('Y-m-d');
                $outflight->where(DB::raw("concat_ws(' ',arrive_date,arrive_time)"), "<=", $prev_date." ". $prev_time);
            } else {
                $outflight->where("arrive_date", "<=", $prev_date);
            }
            $out = $outflight->orderby("price", "asc")
                             ->first();
            $return_flight    = $val->getStadium->getNearestAirport->flightFrom()
                                    ->where("flightmode", "=", 2)
                                    ->whereRaw(DB::raw("departure_date between '".$match_tomorow."' and '".$next_date."'"))
                                    ->where("departure_date", ">=", date("Y-m-d"))
                                    ->orderby("price", "asc")
                                    ->first();
            if(empty($out->id) or empty($return_flight->id)) {
                break;
            }
            $date1         = new DateTime($return_flight->departure_date);
            $date2         = new DateTime($out->arrive_date);
            $interval      = $date1->diff($date2);
//            $days_book     = $interval->d + 1;
            $days_book     = $interval->d; // Booking days is equal to the difference of flight dates
            $hotel_price   = Accomodation::where("city", "=", $val->getStadium->city)
                            ->min("low_season_prices");
            if(empty($hotel_price)) {
                break;
            }
            $match[$key]['country_name'] = $val->getStadium->country->name;
            $match[$key]['city_name']    = $val->getStadium->cities->name;
            $match[$key]['tournament']   = $val->getTournament->name;
            $match[$key]['stadium']      = $val->getStadium->stadium;
            $image = url("assets/img/no-image-available.png");
            if(File::exists(base_path(). '/public/uploads/matches/'.$val->image_name) and !empty($val->image_name)){
                $image = url("uploads/matches/".$val->image_name);
            }
            $match[$key]['image']        = $image;
            $match[$key]['home_club']    = $val->getHomeClub->name;
            $match[$key]['away_club']    = $val->getAwayClub->name;
            $match[$key]['match_date']   = date("d", strtotime($val->match_date));
            $match[$key]['match_month']  = date("M", strtotime($val->match_date));
            $match[$key]['match_id']     = $val->id;
            $match[$key]['min_price']    = (addAdditionalPrice($val->competitionSeatingGet->min('price'))+addAdditionalPrice($out->price) + addAdditionalPrice($return_flight->price) + (addAdditionalPrice($hotel_price) * $days_book));
        }
        $sort_type  = $request->input("sorttype");
        $sort_order = $request->input("sortorder");
        if($sort_type!="" and $sort_order !=""){
            $order = (($sort_order == "asc")? SORT_ASC : SORT_DESC);
            switch ($sort_type) {
                case "price" :
                    array_sort_by_column($match, 'min_price', $order);
                    break;
                case "date":
                    array_sort_by_column($match, 'match_date', $order);
                    break;
                default :
            }
        }
        $resp['matches']  = $match;
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
    public function addPackageToCart($match_id, Request $request) {
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
            $response['message'] = "You have already selected a ticket. Please remove it from the cart and try to buy new ticket";
        } else {
            $ticket = $match->competitionSeatingGet()->orderby('price', "asc")->first();
            $match_array = [
                "name"       => $match->getHomeClub->name." - ". $match->getAwayClub->name." (".$ticket->seatingCategory->name." Ticket)",
                "price"      => addAdditionalPrice($ticket->price),
                "identifier" => $ticket->id,
            ];

            $match_date       = $match->match_date;
            $date1            = strtotime($match_date);
            $date2            = date("l", $date1);
            $weekday          = strtolower($date2);
            $prev_date        = date('Y-m-d', strtotime($match_date .' -1 day'));
            $next_date        = date('Y-m-d', strtotime($match_date .' +2 day'));
            $prev_time        = date('H:i:s', strtotime($match_date .' -1 day'));
            $match_tomorow    = date('Y-m-d', strtotime($match_date .' +1 day'));
            $outflight        = $match->getStadium->getNearestAirport->flightTo()
                                      ->where("flightmode", "=", 1)
                                      ->where("departure_date", ">=", date("Y-m-d"));
            if($weekday == "sunday" or $weekday == "saturday") {
                $prev_date = date('Y-m-d', strtotime($match_date) - 60 * 60 * 6);
                $prev_time = date("H:i:s", strtotime($match_date) - 60 * 60 * 6);
                $date      = new DateTime($match_date);
                $date->modify('next monday');
                $next_date = $date->format('Y-m-d');
                $outflight->where(DB::raw("concat_ws(' ',arrive_date,arrive_time)"), "<=", $prev_date." ". $prev_time);
            } else {
                $outflight->where("arrive_date", "<=", $prev_date);
            }
            $out          = $outflight->orderby("price", "asc")
                                      ->first();
            $return       =  $match->getStadium->getNearestAirport->flightFrom()
                                ->where("flightmode", "=", 2)
                                ->whereRaw(DB::raw("departure_date between '".$match_tomorow."' and '".$next_date."'"))
                                ->where("departure_date", ">=", date("Y-m-d"))
                                ->orderby("price", "asc")
                                ->first();
            $flight_array = [
                "name"          => "Flight Ticket",
                "dept_flight"   => $out->id,
                "return_flight" => $return->id,
            ];

            $accomo        = $match->getStadium->cities->accomodation()
                ->orderby("low_season_prices", "asc")
                ->first();
            $date1         = new DateTime($return->departure_date);
            $date2         = new DateTime($out->arrive_date);
            $interval      = $date1->diff($date2);
//            $days_book     = $interval->d + 1;
            $days_book     = $interval->d; // Booking days is equal to the difference of flight dates
            $cart_array = [
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

    public function getMatch($match_id, Request $request) {
        if(!$request->session()->has("cart_match") and $request->session()->get("cart_match") != $match_id) {
            return redirect(url());
        }
        $cart_match = $request->session()->get("match_data");
        $cart_qty   = $request->session()->get("cart_quantity");
        $match = Match::findOrFail($match_id);
        // Show the login page
        return View::make('voetbaltrips_frontend.match', ['match'=>$match, 'match_id'=>$match_id, "cart_match"=> $cart_match, "cart_qty" => $cart_qty]);
    }
    /**
     * @param $match_id
     * @param Request $request
     * @return Redirect
     * Here check that user has already selected any match
     * if user selected any match then there cannot select another match
     */
    public function addMatchToCart($match_id, Request $request) {
        $response['status']  = "error";
        $response['message'] = "Unable to add match ticket to the cart";
        $rules =[
            "ticket"          => "required",
            "ticket_quantity" => "required"
        ];
        $validator               = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            $response['message'] = "Seating type and number of tickets is required to book a match";
            return response()->json($response);
        }
        /**
         * Checking that required quantity of ticket is available to buy
         * If there is no enough quantity then it will return error
         */
        $checkQuantityAvailable = $this->checkMatchTicketAvailable($match_id, $request->all());
        if($checkQuantityAvailable['status'] == "error") {
            return response()->json($checkQuantityAvailable);
        }
        $match               = Match::find($match_id);
        $ticket_price        = Competition_seating::find($request->input("ticket"));
        $request->session()->set("cart_quantity", $request->input("ticket_quantity"));
        $match_array = [
            "name"       => $match->getHomeClub->name." - ". $match->getAwayClub->name." (".$ticket_price->seatingCategory->name." Ticket)",
            "price"      => addAdditionalPrice($ticket_price->price),
            "identifier" => $request->input("ticket"),
        ];
        $request->session()->set("match_data", $match_array);
        $response['status']   = "success";
        $response['message']  = "Package updated.";
        return response()->json($response);
    }
    private function checkMatchTicketAvailable($match_id, $request) {
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
        if(($available_tickets - $request['ticket_quantity']) >=0) {
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
    public function flightSelection($match_id, Request $request) {
        if(!$request->session()->has("cart_match")){
            return redirect(url());
        }
        //dd($request->session()->get("cart_flight"));
        $match            = Match::findorFail($match_id);

        $airports         = Airportlist::where("showinsearch", "=",1)
                            ->whereNotIn("id", [$match->getStadium->nearest_airport])
                            ->whereHas("flightFrom", function ($q){
                                $q->where("flightmode", "=", 1);
                                $q->where("departure_date", ">=", date("Y-m-d"));
                            })
                            ->orWhereHas("flightTo", function ($q){
                                $q->where("flightmode", "=", 2);
                                $q->where("departure_date", ">=", date("Y-m-d"));
                            })
                            ->orderby("title", "asc")
                            ->get();
       //dd($airports);
        $from_airport = "";
        $to_airport   = $match->getStadium->nearest_airport;
        $from = $match->getStadium->getNearestAirport->flightTo(function ($q) {
            $q->where("departure_date", ">=", date("Y-m-d"));

        })->first();
        $from_airport = $from->from;
        return view('voetbaltrips_frontend.flight', [
            "match_id"          => $match_id,
            "match"             => $match,
            "airports"          => $airports,
            "from_airport"      => $from_airport,
            "to_airport"        => $to_airport
        ]);
    }

    public function searchFlights(Request $request) {
        $response['status'] = "error";
        $match            = Match::find($request->input("match_id"));
        $match_date       = $match->match_date;
        $date1            = strtotime($match_date);
        $date2            = date("l", $date1);
        $weekday          = strtolower($date2);
        $dept_airports    = Airportlist::find($match->getStadium->nearest_airport);
        /**
         * If the match is on saturday or sunday.
         * Show flights until saturday morning and return flights on monday.
         * So return 1 day after the match.
         * Show flights until 6 hours before the match.
         * Show return flights from monday onwards.
         * */
        $prev_date        = date('Y-m-d', strtotime($match_date .' -1 day'));
        $next_date        = date('Y-m-d', strtotime($match_date .' +2 day'));
        $prev_time        = date('H:i:s', strtotime($match_date .' -1 day'));
        $match_tomorow    = date("Y-m-d", strtotime($match_date .' +1 day'));



        ///Outbase

        $airports_in_country = Airportlist::where("country_id", "=", $match->getStadium->country_id)->lists('id');
// ->whereIn('to', $airports_in_country);

        $base_outgoing_flight  = Flight::where("flightmode", "=", '1')
            ->where("departure_date", ">=", date("Y-m-d"))
            ->where("to", "=", $match->getStadium->nearest_airport);

        if($weekday == "sunday" or $weekday == "saturday") {
            $prev_date = date('Y-m-d', strtotime($match_date) - 60 * 60 * 6);
            $prev_time = date("H:i:s", strtotime($match_date) - 60 * 60 * 6);
            $date      = new DateTime($match_date);
            $date->modify('next monday');
            $next_date = $date->format('Y-m-d');
            $base_outgoing_flight->where(DB::raw("concat_ws(' ',arrive_date,arrive_time)"), "<=", $prev_date." ". $prev_time);
        }else {
            $base_outgoing_flight->where("arrive_date", "<=", $prev_date);
        }


        ///->where("to", "=", $match->getStadium->nearest_airport);


        $outgoing_flight  = Flight::where("flightmode", "=", '1')
            ->where("departure_date", ">=", date("Y-m-d"))
            ->whereIn('to', $airports_in_country);
        if(count($request->input("airports")) > 0) {
            $outgoing_flight->whereIn("from", $request->input("airports"));
        }
        if($weekday == "sunday" or $weekday == "saturday") {
            $prev_date = date('Y-m-d', strtotime($match_date) - 60 * 60 * 6);
            $prev_time = date("H:i:s", strtotime($match_date) - 60 * 60 * 6);
            $date      = new DateTime($match_date);
            $date->modify('next monday');
            $next_date = $date->format('Y-m-d');
            $outgoing_flight->where(DB::raw("concat_ws(' ',arrive_date,arrive_time)"), "<=", $prev_date." ". $prev_time);
        }else {
            $outgoing_flight->where("arrive_date", "<=", $prev_date);
        }


        $departure_date   = date("Y-m-d");

        //

       $airports_in_country = Airportlist::where("country_id", "=", $match->getStadium->country_id)->lists('id');


        $return_flight    = Flight::where("flightmode", "=", 2)
            ->whereRaw(DB::raw("departure_date between '".$match_tomorow."' and '".$next_date."'"))
            ->whereIn('from', $airports_in_country);
        if(count($request->input("airports")) > 0) {
            $return_flight->whereIn("to", $request->input("airports"));
        }
        if($request->input("flightdate")!="") {
            $flightdate = date("Y-m-d", strtotime($request->input("flightdate")));
            $outgoing_flight->where("departure_date", "=", $flightdate);
        }
        if($request->input("todate")!="") {
            $returndate = date("Y-m-d", strtotime($request->input("todate")));
            $return_flight->where("departure_date", "=", $returndate);
        }
        if($request->input("sorttype") =="returnprice" and $request->input("sortorder") == "desc") {
            $return_flight->orderby("price", "desc");
        } else {
            $return_flight->orderby("price", "asc");
        }
        if($request->input("sorttype") =="outprice" and $request->input("sortorder") == "desc") {
            $outgoing_flight->orderby("price", "desc");
        } else {
            $outgoing_flight->orderby("price", "asc");
        }
        $base_out_flights = $base_outgoing_flight->get();
        $out_flights = $outgoing_flight->get();
        $ret_flights = $return_flight->get();
        $response['out_count'] = count($out_flights);
        $response['to_count']  = count($ret_flights);
        $base_out_min_price = addAdditionalPrice($base_outgoing_flight->min("price"));
        $out_min_price = addAdditionalPrice($outgoing_flight->min("price"));
        $ret_min_price = addAdditionalPrice($return_flight->min("price"));
        $cart_flight   = $request->session()->get("cart_flight");
        $from_flight_data = '<div class="product-title">Outgoing Flight</div><table class="table table-bordered" cellspacing="5" cellpadding="5" ><tr><th>#</th><th>Airline</th><th>From</th> <th>To</th><th>Time</th><th>Price <span class="glyphicon '.(($request->input("sortorder") == "desc" and $request->input("sorttype")=="outprice")? 'glyphicon-triangle-top':'glyphicon-triangle-bottom').'" id="outsort" style="cursor:pointer;"></span></th> </tr> <tbody >';
        $from_flights_selected = 'checked';
        foreach($out_flights as $key=>$flight) {
            $departureDateTime = Carbon::parse($flight->departure_date.' '.$flight->departure_time);

//            $from_flight_data.= '<tr>  <td><input required="required" type="radio" '.(($flight->id == $cart_flight['dept_flight'])?'checked="checked"':"").' name="dept_flight" required="required" value="'.$flight->id.'"></td><td>'.ucwords($flight->airline->name).'</td> <td>'.$flight->source_airport->title.'</td><td>'.$flight->destination_airport->title.'</td> <td>'.$flight->departure_date.' '.$flight->departure_time.'</td><td>'.(number_format(addAdditionalPrice($flight->price) - $base_out_min_price, 2) >= 0 ? '+' : '-').' '.abs(number_format(addAdditionalPrice($flight->price) - $base_out_min_price, 2)).' p.p.</td></tr>';
            $from_flight_data.= '<tr>  <td><input required="required" type="radio" '.(($flight->id == $cart_flight['dept_flight'])?'checked="checked"':"").' name="dept_flight" required="required" value="'.$flight->id.'"></td><td>'.ucwords($flight->airline->name).'</td> <td>'.$flight->source_airport->title.'</td><td>'.$flight->destination_airport->title.'</td> <td>'.$departureDateTime->format('Y-m-d H:i').'</td><td>'.(number_format(addAdditionalPrice($flight->price) - $base_out_min_price, 2) >= 0 ? '+' : '-').' '.abs(number_format(addAdditionalPrice($flight->price) - $base_out_min_price, 2)).' p.p.</td></tr>';
            $from_flights_selected = '';
        }
        $from_flight_data.='</tbody></table>';
        $return_flight_data = '<div class="product-title">Return Flight</div><table class="table table-bordered" cellspacing="5" cellpadding="5" >
                                    <tr>
                                        <th>#</th>
                                        <th>Airline</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Time</th>
                                        <th>Price <span class="glyphicon '.(($request->input("sortorder") == "desc" and $request->input("sorttype")=="returnprice")? 'glyphicon-triangle-top':'glyphicon-triangle-bottom').'" id="returnsort" style="cursor:pointer;"></span></th>
                                    </tr>
                                    <tbody >';
        $ret_flights_selected = 'checked';
        foreach($ret_flights as $key=>$flight){
            $departureDateTime = Carbon::parse($flight->departure_date.' '.$flight->departure_time);

//            $return_flight_data.= '<tr>  <td><input required="required" '.(($flight->id == $cart_flight['return_flight'])?'checked="checked"':"").' type="radio" name="return_flight" required="required" value="'.$flight->id.'"></td><td>'.ucwords($flight->airline->name).'</td> <td>'.$flight->source_airport->title.'</td><td>'.$flight->destination_airport->title.'</td><td>'.$flight->departure_date.' '.$flight->departure_time.'</td><td>+ '.number_format(addAdditionalPrice($flight->price)- $ret_min_price,2).' p.p.</td></tr>';
            $return_flight_data.= '<tr>  <td><input required="required" '.(($flight->id == $cart_flight['return_flight'])?'checked="checked"':"").' type="radio" name="return_flight" required="required" value="'.$flight->id.'"></td><td>'.ucwords($flight->airline->name).'</td> <td>'.$flight->source_airport->title.'</td><td>'.$flight->destination_airport->title.'</td><td>'.$departureDateTime->format('Y-m-d H:i').'</td><td>+ '.number_format(addAdditionalPrice($flight->price)- $ret_min_price,2).' p.p.</td></tr>';
            $ret_flights_selected = '';
        }
        $return_flight_data.='</tbody> </table>';
        $response['return_flight'] = $return_flight_data;
        $response['from_flight']   = $from_flight_data;
        return response()->json($response);
    }
    public function showRoomForMatch($match_id, Request $request) {
        if(!$request->session()->has("cart_match") or !$request->session()->has("cart_flight")){
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
        $accomodations = Accomodation::where("city", "=",$match->getStadium->city)
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
            $accomo              = Accomodation::find($request->input("accomo"));
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
        $total = 0;
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']      = $request->session()->get('cart_match');
            $cart_data['quantity']      = $request->session()->get('cart_quantity');
            $cart_data['match_data']    = $request->session()->get('match_data');
            $total                      = ($total + ($cart_data['match_data']['price'] * $cart_data['quantity']));
        }
        if ($request->session()->has('cart_flight')) {
            $flight_array               = $request->session()->get("cart_flight");
            $dept                       = Flight::find($flight_array['dept_flight']);
            $return                     = Flight::find($flight_array['return_flight']);
            $cart_data['dept_flight']   = $dept;
            $cart_data['return_flight'] = $return;
            $total                      = ($total + (addAdditionalPrice($dept->price) *$cart_data['quantity']) + (addAdditionalPrice($return->price) * $cart_data['quantity']));
        }
        if($request->session()->has("cart_room")) {
            $room_array                 = $request->session()->get("cart_room");
            $cart_data['room']          = $room = $room_array;
            $room_total                 = ($room_array['price']*$cart_data['quantity']);
            if($room['include_breakfast'] == "on") {
                $room_total = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
            }
            $total = ($total + ($room_total * $room_array['room_days']));
        }
        if($request->session()->has("cart_options")) {
            $cart_options         = $request->session()->get("cart_options");
            $cart_data['options'] = $cart_options;
            $opt_tot              = 0;
            foreach ($cart_options as $opt) {
                $opt_tot = ($opt_tot + ($opt['price'] * $opt['qty']));
            }
            $total = ($total+$opt_tot);
        }
        $cart_data['total_amount']  = $total;
        $travel_info                = $request->session()->get('travelinfo');
        return view("voetbaltrips_frontend.cartsummary", compact('cart_data', 'travel_info'));
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
            $flight_array = [
                "name"          => "Flight Ticket",
                "dept_flight"   => $request->input("dept_flight"),
                "return_flight" => $request->input("return_flight"),
            ];
            $request->session()->set("cart_flight", $flight_array);
            $out                = Flight::findOrFail($request->input("dept_flight"));
            $return             = Flight::findOrFail($request->input("return_flight"));
            $date1              = new DateTime($return->departure_date);
            $date2              = new DateTime($out->arrive_date);
            $interval           = $date1->diff($date2);
//            $days_book          = $interval->d + 1;
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
        return redirect(url("login"));
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


    public function saveTravellerInformation($match_id, Request $request) {
        if(!$request->session()->has("cart_match")) {
            return redirect(url());
        }
        $rules = [
//            "traveller_name"    => "required",
            "traveller_first_name"    => "required",
            "traveller_last_name"    => "required",
            "dob"               => "required",
            "gender"            => "required"
        ];
        $validation = Validator::make($request->all(), $rules);
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

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
        $match = Match::findorFail($match_id);
        $options = Option::get();
        return View('voetbaltrips_frontend.options', [
            "match"        => $match,
            "options"      => $options,
            "match_id"     => $match_id,
            "cart_show"    => $cartshow,
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
        $response['message'] = "Something went wrong. Please try again later!!";
        $rules = [
            "qty"      => "required",
            "identity" => "required"
        ];
        $validate = Validator::make($request->all(), $rules);
        if($validate->passes()) {
            $opt = Option::findorFail($request->input("identity"));
            $response['message'] = "You have successfully added <i>".$opt->title."</i> to the Cart";
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
                        "qty"    => $request->input("qty"),
                    ];
                } else {
                    /**
                     * The cart item is exist
                     */
                    $cart[$check_cart]['qty'] = $request->input("qty");
                    $response['message'] = "You have successfully updated <i>".$opt->title."</i> Cart Quantity";
                }
                $request->session()->put("cart_options", $cart);
            } else {
                $cart_array[] = [
                    "name"   => $opt->title,
                    "price"  => addAdditionalPrice($opt->price),
                    "opt_id" => $request->input("identity"),
                    "qty"    => $request->input("qty"),
                ];
                $request->session()->put("cart_options", $cart_array);
            }
            $response['status']  = "success";
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
            $response['message'] = "Option <i>".$opt->title."</i> removed from the cart Successfully.";
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
        $data = '<div class="col-md-6 col-md-offset-0"><img src="'.((File::exists(base_path()."/public/uploads/hotel/".$accomodations->images) == true) ? url("uploads/hotel/".$accomodations->images): url("assets/img/no-image-available.png")).'"><div class="product-description"><p>'.$accomodations->description.'</p></div></div><div class="col-md-6 col-md-offset-0"><h4>Address</h4><p>'.$accomodations->address.',&nbsp;'.$accomodations->cityobj->name.',&nbsp;'.$accomodations->country->name.'</p><input id="rating-system" type="number" class="rating-loading" data-min="0" data-max="5" data-step="1" value="'.$accomodations->stars.'" name="stars"/>';
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
    public function getCartTotalPrice(Request $request) {
        $total = 0;
        $subtotal = 0;
        $response['total'] = "";
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']    = $request->session()->get('cart_match');
            $cart_data['quantity']    = $request->session()->get('cart_quantity');
            $cart_data['match_data']  = $request->session()->get('match_data');
            $total                    = ($total + ($cart_data['match_data']['price']*$cart_data['quantity']));
            $subtotal = $cart_data['match_data']['price'];
        }
        if ($request->session()->has('cart_flight')) {
            $flight_array               = $request->session()->get("cart_flight");
            $dept                       = Flight::find($flight_array['dept_flight']);
            $return                     = Flight::find($flight_array['return_flight']);
            $cart_data['dept_flight']   = $dept;
            $cart_data['return_flight'] = $return;
            $total                      = ($total + (addAdditionalPrice($dept->price) *$cart_data['quantity']) + (addAdditionalPrice($return->price) * $cart_data['quantity']));
            $subtotal = ($subtotal + (addAdditionalPrice($dept->price) + addAdditionalPrice($return->price)));
        }
        if($request->session()->has("cart_room")) {
            $room_array        = $request->session()->get("cart_room");
            $cart_data['room'] = $room_array;
            $room_sub_price    = $room_array['price'];
            $room_total                 = ($room_array['price']*$cart_data['quantity']);
            if($room_array['include_breakfast'] == "on") {
                $room_total = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
                $room_sub_price = $room_sub_price + $room_array['breakfast_price'];
            }
            $total = ($total+($room_total * $room_array['room_days']));
            $subtotal = ($subtotal + ($room_sub_price * $room_array['room_days']));
        }
        $opt_tot = 0;
        if($request->session()->has("cart_options")) {
            $cart_options         = $request->session()->get("cart_options");
            $cart_data['options'] = $cart_options;
            foreach ($cart_options as $opt) {
                $opt_tot = ($opt_tot + ($opt['price'] * $opt['qty']));
            }
            $total = ($total+$opt_tot);
        }
        if($subtotal >0) {
            $response['total']         = "<div class='row text-center' style='background-color: #00579b;border-color: #00579b; line-height: 3.429;'> <span class='text-center' style='color: rgba(255, 255, 255, 0.8);' id='package_show'><span class='cart_item'>".$cart_data['quantity']." X ".$subtotal. (($opt_tot>0)?" + {$opt_tot}":"")." = ".(($cart_data['quantity']*$subtotal)+$opt_tot). "</span><span class='cartempty' id='resetcart'>empty cart</span></span>";
        }
        return response()->json($response);
    }


    public function checkEverythingBeforeConfirmCart(Request $request) {
        $response['status']  = "error";
        $response['message'] = "Unable to complete the cart";
        $cart_qty            = $request->session()->get("cart_quantity");
        $travelinfo          = $request->session()->get("travelinfo");
        $count_travellers    = count($travelinfo['traveller_name']);
        if($cart_qty == $count_travellers) {
            $response['status']  = "success";
            $response['message'] = "Cart validation success";
        } else {
            $response['message'] = "Please fill the traveller information before you proceed.";
        }
        return response()->json($response);
    }
}