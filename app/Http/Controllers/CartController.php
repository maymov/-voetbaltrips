<?php
namespace App\Http\Controllers;
use App\Accomodation;
use App\Cities;
use App\Competition_seating;
use App\Flight;
use App\Match;
use App\Option;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mollie\Laravel\Facades\Mollie;
use Sentinel;
use Cart;
use App\User;
use App\UsersCart;
use App\Order;
use App\OrderMatch;
use App\OrderFlight;
use App\OrderAccomodation;
use App\TravellerInfo;
use Illuminate\Support\Facades\File;
use App\OrdersOptions;
use App\Mails;

class CartController extends Controller
{
    protected $user;
    public function __construct() {
        $this->user            = Sentinel::getUser();
        if(!\Session::has('match_data')) {
            return redirect(url());
        }
    }
    /**
     * Here shows the payment method the user want to use
     * WHen the user press on the confirm button then create the order and then redirect to payment page
     * 
     * @return [type] [description]
     */
    public function paymentSelection(Request $request) {
        if(!$request->session()->has("cart_match")){
            return redirect(url());
        }
        $total = 0;
        if ($request->session()->has('cart_match')) {
            $cart_data['match_id']    = $request->session()->get('cart_match');
            $cart_data['quantity']    = $request->session()->get('cart_quantity');
            $cart_data['match_data']  = $request->session()->get('match_data');
            $total                    = ($total + ($cart_data['match_data']['price'] * $cart_data['quantity']));
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
            $cart_data['room'] = $room = $room_array;
            $room_total                 = ($room_array['price']*$cart_data['quantity']);
            if($room_array['include_breakfast'] == "on") {
                $room_total = ($room_total+($room_array['breakfast_price'] * $cart_data['quantity']));
            }
            $total = ($total+($room_total * $room_array['room_days']));
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

        return view("voetbaltrips_frontend.cartpaymentselection", compact('cart_data', 'travel_info'));
    }
    /**
     * This method is used to create order
     * Here save all the cart details to the table
     * After the order is created then the page redirect to payment page
     * @return [type] [description]
     */
    public function paymentConfirm(Request $request) {
        /**
         * Creating the order
         */

        $order = Order::create([
            "users_id"          => $this->user->id,
            "first_name"        => $this->user->first_name,
            "last_name"         => $this->user->last_name,
            "gender"            => $this->user->gender,
            "country"           => $this->user->country,
            "state"             => $this->user->state,
            "city"              => $this->user->city,
            "address"           => $this->user->address,
            "postal"            => $this->user->postal,
            "payment_method"    => "",
            "payment_status"    => 9,
            "order_status"      => 1,
        ]);

        if ($request->session()->get('ticketstohome') == 1) {
            $order->sent_tickets_home = 1;
            $order->save();
        }
        /**
         *
         * Cart contents are already exist in the session.
         *
         */

        $match_data   = $request->session()->get("match_data");
        $match_id     = $request->session()->get("cart_match");
        $match = Match::findOrFail($match_id);

        $flight_data  = $request->session()->get("cart_flight");
        $quantity     = $request->session()->get("cart_quantity");
        $room_data    = $request->session()->get("cart_room");
        $seating     = Competition_seating::find($match_data['identifier']);

        $order_match = OrderMatch::create([
            "orders_id"     => $order->id,
            "matches_id"    => $match_id,
            "seat_type"     => $match_data['identifier'],
            "country"       => $match->getStadium->country->name,
            "city"          => $match->getStadium->cities->name,
            "tournament"    => $match->getTournament->name,
            "stadium"       => $match->getStadium->stadium,
            "home_club"     => $match->getHomeClub->name,
            "away_club"     => $match->getAwayClub->name,
            "match_date"    => date("Y-m-d H:i:s", strtotime($match->match_date)),
            "seating_type"  => $seating->seatingCategory->name,
            "price"         => addAdditionalPrice($seating->price),
            "quantity"      => $quantity
        ]);
        if (!$request->session()->get('only_ticket')){

            $dept_flight = Flight::find($flight_data['dept_flight']);
            OrderFlight::create([
                "orders_id"         => $order->id,
                "flightmode"        => '1',
                "airlines_id"       => $dept_flight->airlines_id,
                "airlines_name"     => $dept_flight->airline->name,
                /*"flight_number"     => $flight->flight_number,*/
                "departure_airport" => $dept_flight->source_airport->title,
                "arrival_airport"   => $dept_flight->destination_airport->title,
                "via"               => $dept_flight->via,
                "departure_date"    => $dept_flight->departure_date,
                "departure_time"    => $dept_flight->departure_time,
                "arrive_date"       => $dept_flight->arrive_date,
                "arrive_time"       => $dept_flight->arrive_time,
                "duration"          => $dept_flight->duration,
                "price"             => addAdditionalPrice($dept_flight->price),
                "quantity"          => $quantity
            ]);

            $return_flight = Flight::find($flight_data['return_flight']);
            OrderFlight::create([
                "orders_id"         => $order->id,
                "flightmode"        => '2',
                "airlines_id"       => $return_flight->airlines_id,
                "airlines_name"     => $return_flight->airline->name,
                /*"flight_number"     => $flight->flight_number,*/
                "departure_airport" => $return_flight->source_airport->title,
                "arrival_airport"   => $return_flight->destination_airport->title,
                "via"               => $return_flight->via,
                "departure_date"    => $return_flight->departure_date,
                "departure_time"    => $return_flight->departure_time,
                "arrive_date"       => $return_flight->arrive_date,
                "arrive_time"       => $return_flight->arrive_time,
                "duration"          => $return_flight->duration,
                "price"             => addAdditionalPrice($return_flight->price),
                "quantity"          => $quantity
            ]);

            $accomo     = Accomodation::find($room_data['accomo_id']);
            $city       = Cities::find($accomo->city);
            $room_total = 0;

            $acc_data = [
                "orders_id"         => $order->id,
                "hotel_name"        => $accomo->name,
                "star"              => $accomo->stars,
                "address"           => $accomo->address,
                "city"              => $accomo->cityobj->name,
                "country"           => $city->country->name,
                "price"             => addAdditionalPrice($accomo->low_season_prices),
                "quantity"          => $quantity,
                "rooms_days"        => $room_data['room_days']
            ];

            $total_breakfast = 0;

            if ($room_data['include_breakfast'] == "on") {
                $total_breakfast = ($room_data['breakfast_price'] * $quantity);
                $acc_data['include_breakfast'] = "yes";
                $acc_data['breakfast_price']   = $room_data['breakfast_price'];
            }

            $room_total = (((addAdditionalPrice($accomo->low_season_prices)*$quantity) + $total_breakfast) * $room_data['room_days']);
            OrderAccomodation::create($acc_data);
            $opt_tot    = 0;

            if ($request->session()->has("cart_options")) {
                $cart_options   = $request->session()->get("cart_options");

                foreach ($cart_options as $opt) {
                    $option = Option::find($opt['opt_id']);
                    OrdersOptions::create([
                        "orders_id"   => $order->id,
                        "options_id"  => $opt['opt_id'],
                        "title"       => $option->title,
                        "description" => $option->description,
                        "price"       => addAdditionalPrice($option->price),
                        "quantity"    => $opt['qty']
                    ]);
                    $opt_tot = ($opt_tot + ($opt['price'] * $opt['qty']));
                }
            }
            $total_amount = ((addAdditionalPrice($seating->price) * $quantity) + ((addAdditionalPrice($dept_flight->price) * $quantity)) + ((addAdditionalPrice($return_flight->price) * $quantity)) + $room_total + $opt_tot);
        } else {
            $total_amount = addAdditionalPrice($seating->price - $seating->discount) * $quantity ;
        }

        /**
         * Update the total price in orders table
         */

        $order->order_total = $total_amount;
        $order->save();

        /**
         *
         * Saving the passengers Information into the table
         */
        if ($request->session()->get("travelinfo")) {

            $travel_info = $request->session()->get("travelinfo");

            for($x=0; $x < $quantity; $x++) {
                /**
                 * Saving the passport image from the session
                 */
                TravellerInfo::create([
                    "order_id"          => $order->id,
                    "name"              => $travel_info['traveller_name'][$x],
                    "first_name"        => $travel_info['traveller_first_name'][$x],
                    "last_name"         => $travel_info['traveller_last_name'][$x],
                    "date_of_birth"     => $travel_info['dob'][$x],
                    "gender"            => $travel_info['gender'][$x],
                    "phone_number"      => (isset($travel_info['traveller_phone'][$x])) ? $travel_info['traveller_phone'][$x] : "not_set",
                    "email"             => (isset($travel_info['traveller_email'][$x])) ? $travel_info['traveller_email'][$x] : "not_set",
                    "postcode"          => (isset($travel_info['traveller_postcode'][$x])) ? $travel_info['traveller_postcode'][$x] : "not_set",
                    "country_text"      => (isset($travel_info['traveller_country'][$x])) ? $travel_info['traveller_country'][$x]: "not_set",
                    "city_text"         => (isset($travel_info['traveller_city'][$x])) ? $travel_info['traveller_city'][$x] : "not_set",
                    "address"            => (isset($travel_info['traveller_address'][$x])) ? $travel_info['traveller_address'][$x] : "not_set",
                ]);
            }
            /**
             * Now redirect the page to payment page
             * For testing here assume that payment is completed and redirect to
             *
             */
        }

        $customer = Mollie::api()->customers()->create([
            "name"  => $this->user->first_name,
            "email" => $this->user->email,
        ]);

        $payment = Mollie::api()->payments()->create([
            "amount"        => $order->order_total,
            "customerId"    => $customer->id,
            "description"   => "Arrangement: ".$order->id,
            "redirectUrl"   => route('payment', ['order' => $order->id]),

        ]);

        $order->mollie_payment_id = $payment->id;

        $order->save();

        return redirect($payment->links->paymentUrl);

    }

    /**
     * This method is used to check the order

     * @return [type] [description]
     */
    public function paymentCheck(Request $request) {

        $order_id    = $request->order;
        $order       = Order::findOrFail($order_id);

         $payment = Mollie::api()->payments()->get($order->mollie_payment_id);

        if ($payment->isPaid())
        {
            //echo "Payment received.";
            $order->mollie_payment_status = "paid";
            $order->save();

        /**
         * Remove the cart items from the temporary table amd cart
         * This should done after the order payment is complete
         */
        $traveller_info['info'] = $request->session()->get('travelinfo');
        $traveller_info['fly'] = $request->session()->get('cart_flight');
        $traveller_info['accom'] = $request->session()->get('cart_room');
        $traveller_info['opt'] = $request->session()->get('cart_options');
        $traveller_info['match'] = $request->session()->get('match_data');

        $request->session()->forget("cart_match");
        $request->session()->forget("cart_quantity");
        $request->session()->forget("match_data");
        $request->session()->forget("cart_flight");
        $request->session()->forget("cart_room");
        $request->session()->forget("travelinfo");
        $request->session()->forget("cart_options");
        $request->session()->forget("ticketstohome");
        $request->session()->forget('show');

        $mail                   = Mails::find(2);
        $content                = [];
        $m                      = ['title' => '', 'to' => $traveller_info['info']['traveller_email'][0]];
        
        if(isset($traveller_info['fly']['date_flight_dep']->date)) {
        	$dat_dep                = date("d, F", strtotime($traveller_info['fly']['date_flight_dep']->date));
    	}
    	if(isset($traveller_info['fly']['date_flight_arr']->date)) {
        	$dat_arr                = date("d, F", strtotime($traveller_info['fly']['date_flight_arr']->date));
    	}
    	if(isset($traveller_info['info']['traveller_first_name'][0])) {
        	$content['full_name']   = $traveller_info['info']['traveller_first_name'][0] . ' ' . $traveller_info['info']['traveller_last_name'][0];
    	}

	//adding pdf invoice
    if(isset($traveller_info['info']['traveller_address'][0])) {
        $content['address']     = $traveller_info['info']['traveller_address'][0];
    }
    if(isset($traveller_info['info']['traveller_city'][0])) {
        $content['city']        = $traveller_info['info']['traveller_city'][0];
    } 
    if(isset($traveller_info['info']['traveller_postcode'][0])) {
        $content['postal']      = $traveller_info['info']['traveller_postcode'][0];
    }
        $content['invoice_id']  = $order->id;
        $content['order_date']  = $order->created_at->format('d/m/Y');
        $content['hotel']       = $order->getHotelDetails;
        $content['flight']      = $order->getOrderFlightDetails;
        $content['match']       = $order->getMatchesOrder;
        $content['options']     = $order->getOrderOptions;

    	if(isset($traveller_info['match']['for_cart'])) {
        	$content['match_name']  = $traveller_info['match']['for_cart'];
    	} 
    	if(isset($traveller_info['fly']['dept_flight']) &&  isset($dat_dep)) {
        	$content['fly_dept']    = '' . $dat_dep . ', Flight: ' . $traveller_info['fly']['dept_flight'];
    	}
    	if(isset($traveller_info['fly']['return_flight']) && isset($dat_arr)) {
        	$content['fly_arr']     = "". $dat_arr . ', Flight: ' .  $traveller_info['fly']['return_flight'];
    	}

    	if(isset($traveller_info['accom']['name'])) {
        	$content['accom_name']  = $traveller_info['accom']['name'];
    	}

        foreach ($mail->getTranslate as $trans) {
            if ($trans->lang_code = $request->session()->get('lang_code')) {
                $m['title'] = $trans->title;
                $content['message'] = $trans->text;
            }
        }
        $content['total'] = "&euro;".$order->order_total;
        $content['quantity'] = $order->getMatchesOrder->quantity;

//dd($content);
//	return \PDF::loadView('pdf.invoice', $content)->stream();
	$pdfInvoice = \PDF::loadView('pdf.invoice', $content);


        \Mail::send('admin.mails.blades.total', ['content' => $content], function ($message) use ($m, $pdfInvoice){
            $message->to($m['to'])->subject($m['title']);
	        $message->bcc("info@voetbaltrips.com");
            $message->attachData($pdfInvoice->output(), "invoice.pdf");
        });
        return redirect(url("my-orders"))->with('mail', 'success');
    }else{
            echo "payment failed. Error code: 3001";
        }

    }

}
