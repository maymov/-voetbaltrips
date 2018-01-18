<?php

namespace App\Http\Controllers;

use App\TransCity;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Club;
use App\Cities;
use App\Country;
use App\Tournament;
use App\Match;
use App\Competition_seating;
use File;
use View;
use Validator;
use DB;
use Translater;
use Session;


class TicketOnlySaleController extends  JoshController
{
	public function getIndexTickets(Request $request)
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
		return View::make('only_tickets.index', compact('club', 'clubId', 'cityId', 'tournamentId', 'city', 'tournaments', 'city_uri', 'club_uri', 'tournament_uri', 'matches', 'ajaxload_match', 'home'));
	}

	public function getAjaxTickets(Request $request)
	{
        $resp['cities'] = [];
        if ($request->input("loadcities") == "yes") {
            $resp['cities'] = $this->getAjaxCitiesByTournament($request->input("tournament"));
        }

        $resp['clubs'] = [];
        if ($request->input("loadclub") == "yes") {
            if (count($resp['cities']) > 0) {
                $resp['clubs'] = $this->getAjaxClubs($resp['cities']);
            } else {
                $resp['clubs'] = $this->getAjaxClubs($request->input("city"));
            }
        }

		$getmatch = Match::with("getStadium", "getTournament", "competitionSeatingGet", "getAwayClub", "getHomeClub")->where("match_date", ">=", date('Y-m-d H:i:s', strtotime("+10 days")));

		if (!empty($request->input("tournament"))) {
			$getmatch->where("tournament", "=", $request->input("tournament"));
		}

		if (!empty($request->input("club"))) {
			$getmatch->where("home_club", "=", $request->input("club"));
			$getmatch->orWhere("away_club", "=", $request->input("club"));
		}

		if (!empty($request->input("city"))) {
			$city = $request->input("city");
			$getmatch->whereHas('getStadium', function($q) use($city) {
				$q->where('city', '=', $city);
			});
		}

		if (!empty($request->input("match_date"))) {
            $getmatch->whereDate("match_date", "=", date('Y-m-d' , strtotime($request->input("match_date"))));
        } else {
            $getmatch->whereDate("match_date", ">=", date('Y-m-d H:i:s'));
        }

		$getmatch->whereHas("competitionSeatingGet", function($q){
			$q->where("price", ">", 0);
		});

		$getmatch->whereHas("getTournament", function ($q) {
			$q->where("end_date", ">=", date("Y-m-d"));
		});

		$getmatch->orderby("match_date", "asc");
		$match_result     = $getmatch->get();
		$result           = [];

		foreach($match_result as $key=>$val) {

			$tickets = $val->competitionSeatingGet ;
			$min_price = 10000;
			foreach ($tickets as $t) {
				if (floatval($t->price) != 0 && $t->price < $min_price) {
					$min_price = $t->price - $t->discount;
				}
			}
			if ($min_price == 10000) {
				break;
			}

			$val->setoptions    = [];
			$match_date         = date('Y-m-d', strtotime($val->match_date));
			$match              = [];
			foreach ($val->getStadium->country->getTranslate as $c) {
				if ($c->lang_code == Session::get('lang_code')) {
					$match[$key]['city_name'] = $c->trans_name;
				}
			}
			foreach ($val->getStadium->cities->getTranslate as $c) {
				if ($c->lang_code == Session::get('lang_code')) {
					$match[$key]['country_name'] = $c->trans_name;
				}
			}
			$match[$key]['tournament']   = $val->getTournament->name;
			$match[$key]['stadium']      = $val->getStadium->stadium;

			$image = url("assets/img/no-image-available.png");
			if(File::exists(base_path(). '/public/uploads/matches/'.$val->image_name) and !empty($val->image_name)){
				$image = url("uploads/matches/".$val->image_name);
			}

			$match[$key]['image']               = $image;
			$match[$key]['home_club']           = $val->getHomeClub->name;
			$match[$key]['home_club_emblem']    = "/uploads/teamemblems/" . $val->getHomeClub->emblem;
			$match[$key]['away_club']           = $val->getAwayClub->name;
			$match[$key]['away_club_emblem']    = "/uploads/teamemblems/" . $val->getAwayClub->emblem;
			$match[$key]['match_date']          = date("d", strtotime($val->match_date));
			$match[$key]['match_month']         = date("M", strtotime($val->match_date));
			$match[$key]['match_id']            = $val->id;
			$match[$key]['min_price']           = floatval($min_price);
			$match[$key]['button_book']         = Translater::getValue('button-book-now');
			$match[$key]['label_since']         = Translater::getValue('label-since-small');
			$result[]                           = $match;
		}

		if (empty($result)) {
			$result['status'] = "empty";
			$result['message'] = Translater::getValue('message-no-matches-found');
		}
		return response()->json($result);
	}

	public function getAjaxCitiesByTournament($tournament)
    {

        $matches = Match::where('tournament', $tournament)->get();
        $citiesIds = [];

        foreach($matches as $match) {
            if(!in_array($match->getHomeClub->city, $citiesIds)) {
                $citiesIds[] = $match->getHomeClub->city;
            }
            if(!in_array($match->getAwayClub->city, $citiesIds)) {
                $citiesIds[] = $match->getAwayClub->city;
            }
        }

         $citiesWithCountry = DB::table('cities as c1')
            ->join('country as c2', 'c1.country_id', '=', 'c2.id')
            ->join('trans_city as t1', 'c1.id', '=', 't1.city_id')
            ->join('trans_country as t2', 'c2.id', '=', 't2.country_id')
            ->where('t1.lang_code', '=', Session::get('lang_code'))
            ->where('t2.lang_code', '=', Session::get('lang_code'))
            ->whereIn('c1.id',$citiesIds)
            ->select('c1.*', 'c2.flag', 't1.trans_name as cityName', 't2.trans_name as countryName')
            ->get();

        return $citiesWithCountry;
    }

    private function getAjaxClubs($cities)
    {
        if(count($cities) > 1){
            $array = [];
            foreach($cities as $city){
                $array[] = $city->id;
            }
            $clubs  = Club::whereIn('city', $array)->get();
        } else {
            $clubs  = Club::where('city','=', $cities)->get();
        }
        return $clubs;
    }

	public function buyTicket($match_id, Request $request)
	{
		$response['status']   = "error";
		$response['message']  = "Unable to add the package to Cart";
		$match                = Match::findOrFail($match_id);

		if ($request->session()->has("cart_match")) {
			$response['message'] = "You have already selected a ticket. Please remove it from the cart and try to buy new ticket";
		} else {
			$ticket = $match->competitionSeatingGet()->where('total_price', '>', 0)->orderby('total_price', "asc")->first();

			$match_array = [
				"name"          => $match->getHomeClub->name . " - " . $match->getAwayClub->name . " (" . $ticket->seatingCategory->name . " Ticket)",
				"price"         => addAdditionalPrice($ticket->total_price),
				"identifier"    => $ticket->id,
				"for_cart"      => $match->getHomeClub->name." - ". $match->getAwayClub->name." ".date("d-m-Y", strtotime($match->match_date))
			];

			$request->session()->set("cart_quantity", 1);
			$request->session()->set("cart_match", $match_id);
			$request->session()->set("match_data", $match_array);
			$request->session()->set("only_ticket", 'only_ticket');
			$response['status'] = "success";
			$response['message'] = "Package has been added to cart.";
		}
		return response()->json($response);
	}

	public function getMatch($match_id, Request $request)
	{
		$home = "tickets";
		if (!$request->session()->has("cart_match") and $request->session()->get("cart_match") != $match_id) {
			return redirect(url());
		}

		$cart_match = $request->session()->get("match_data");
		$cart_qty   = $request->session()->get("cart_quantity");
		$match      = Match::findOrFail($match_id);
		$minPrice   = $request->session()->get('match_data');
		$min        = $minPrice['price'];
		$fixed      = [];
		if ($match->fixed_data == 0) {
			$fixed['val']   = $match->fixed_data;
			$fixed['title'] = Translater::getValue('form-label-information');
			$fixed['text']  = Translater::getValue('form-info-the-date-of-this-match-is-not-fixed');
		}

		return View::make('only_tickets.match', ['match'=>$match, 'match_id'=>$match_id, "cart_match"=> $cart_match, "cart_qty" => $cart_qty, 'min' => $min, 'fixed' => $fixed, 'home' =>$home]);
	}

	public function addTicketToCart($match_id, Request $request)
	{
		$response['status']     = "error";
		$response['message']    = "Unable to add ticket to the cart";
		$rules                  = [
				"ticket"          => "required",
				"ticket_quantity" => "required"
		];

		$validator  = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			$response['message'] = "Seating type and number of tickets is required to book a match";
			return response()->json($response);
		}

		$checkQuantityAvailable = $this->checkMatchTicketAvailable($match_id, $request->all());

		if ($checkQuantityAvailable['status'] == "error") {
			return response()->json($checkQuantityAvailable);
		}

		$match          = Match::find($match_id);
		$ticket_price   = Competition_seating::find($request->input("ticket"));

		$request->session()->set("cart_quantity", $request->input("ticket_quantity"));

		$match_array = [
			"name"       => $match->getHomeClub->name." - ". $match->getAwayClub->name." (".$ticket_price->seatingCategory->name." Ticket)",
			"price"      => addAdditionalPrice($ticket_price->price - $ticket_price->discount),
			"identifier" => $request->input("ticket"),
			"for_cart"      => $match->getHomeClub->name." - ". $match->getAwayClub->name." ".date("d-m-Y", strtotime($match->match_date))
		];

		$request->session()->set("match_data", $match_array);
		$response['status']   = "success";
		$response['message']  = "Tickets updated.";

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

		$orders_match = DB::table("orders_match")
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

		if (($available_tickets - $request['ticket_quantity']) >= 0) {
			$response['status']  = "success";
			$response['message'] = "There is enough tickets are available";
		}
		return $response;
	}

	public function travellerInfo($match_id = NULL, Request $request)
	{
		$home = "tickets";
		if (!$request->session()->has("cart_match")) {
			return redirect(url());
		}
		$total      = $request->session()->get("cart_quantity");
		$match      = Match::find($match_id);
		$country    = Country::lists("name", "name");
		$travelinfo = $request->session()->get("travelinfo");

		return view("only_tickets.travellerinfo", compact('match', 'match_id', 'country', 'total', 'travelinfo', 'home' ));
	}

}
