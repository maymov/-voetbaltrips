<?php

namespace App\Http\Controllers;

use App\TravellerInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use Sentinel;
use Datatables;
use App\OrdersAdditionalFields;
use App\OrdersStatus;
use App\Country;
use Validator;
use File;
class UserOrderController extends Controller
{
    /**
     * Show listing of orders customer made.
     */
    public function index()
    {
        $user  = Sentinel::getUser();
        $order = Order::where("users_id", "=", $user->id)->with("getMatchesOrder")->paginate(15);
        return view("voetbaltrips_frontend.my_orders",[
            "orders"    =>  $order
        ]);
    }
    public function getOrders() {

    }

    public function viewOrder($order_id){

        $order   = Order::find($order_id);
        $country = Country::lists("name", "id");
        $info    = $order->getTravellerInformation()->where("is_updated", "=", 0)->get();

        return view("voetbaltrips_frontend.my_order_view", [
            "order"       => $order,
            "order_id"    => $order_id,
            "country"     => $country,
            "travel_info" => $info
        ]);
    }
    public function saveAdditionalData($order_id, Request $request) {
        OrdersAdditionalFields::create([
            "orders_id"   => $order_id,
            "first_name"  => $request->input("first_name"),
            "last_name"   => $request->input("last_name"),
            "gender"      => $request->input("gender"),
            "passport_number" => $request->input("passport_number")
        ]);
        return redirect("my-orders")->with('success', 'You have successfully added Additional data to book tickets!');;
    }

    public function getTravellerInformation(Request $request) {
        $response['status']   = "error";
        $response['message']  = "Unable to retrieve data. Please try again later...";
        $rules = [
            "identifier" => "required",
        ];
        $validation = Validator::make($request->all(), $rules);

        if($validation->passes()) {
            $travelinfo           = TravellerInfo::findorFail($request->input("identifier"));

            $response['status']         = "success";
            $response['message']        = "Data retrieved successfully";
            $response['first_name']     = $travelinfo->first_name;
            $response['last_name']      = $travelinfo->last_name;
            $response['gender']         = $travelinfo->gender;
            $response['dob']            = $travelinfo->date_of_birth;
            $response['phone_number']   = $travelinfo->phone_number;
            $response['email']          = $travelinfo->email;
            $response['country']        = $travelinfo->country_text;
            $response['city']           = $travelinfo->city_text;
            $response['address']        = $travelinfo->address;
            $response['postcode']       = $travelinfo->postcode;
            $response['dob_show']       = date("d F Y", strtotime($travelinfo->date_of_birth));
        }
        return response()->json($response);
    }

    public function updateTravellerInformation(Request $request) {
        $response['status']   = "error";
        $response['message']  = "Unable to save the traveller information.";
        $travel               = TravellerInfo::findorFail($request->input("change_data"));
        $order_id             = $travel->order_id;
        $rules = [
                  "traveller_first_name"    => "required",
                  "traveller_last_name"     => "required",
                  "birth"                  => "required",
                  "gender"                  => "required",
        ];
        $validation = Validator::make($request->all(), $rules);

        if($validation->passes()) {
            if(!is_dir(public_path('uploads/userdata'))){
                File::makeDirectory(public_path('uploads/userdata'), 0775, true, true);
            }

            $travel->name              = $request->input("traveller_first_name") . ' '. $request->input("traveller_last_name");
            $travel->first_name        = $request->input("traveller_first_name");
            $travel->last_name         = $request->input("traveller_last_name");
            $travel->date_of_birth     = $request->input("birth");
            $travel->gender            = $request->input("gender");
            $travel->nationality       = $request->input("nationality");

            $travel->identity_type     = $request->input("identity_type");
            $travel->passport_number   = $request->input("passport_number");
            $travel->passport_validity = $request->input("passport_validity");
            $file                      = $request->file("passport_document");
            $destinationPath           = public_path('uploads/userdata');
            // GET THE FILE EXTENSION
            $extension                 = $file->getClientOriginalExtension();
            // RENAME THE UPLOAD WITH RANDOM NUMBER
            $fileName                  =  uniqid('pass_').sha1(str_random(30).$file->getClientOriginalName().uniqid().time().rand(100, 999999).microtime()).time().'.'.$extension;
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
            if($file->move($destinationPath, $fileName)) {
                $travel->passport_document = $fileName;
                $travel->is_updated        = 1;
                $travel->save();
                /**
                 * Checking that all traveller informations are updated
                 * If it completed then change the order status to processing
                 */
               $check = TravellerInfo::where("is_updated", "=", 0)->where("order_id", "=", $order_id)->get()->count();
                if($check == 0) {
                    $order = Order::find($order_id);
                    $order->order_status = 2;
                    $order->save();
                }

            } else {
                $response['message']       = "Unable to upload the passport document.";
            }
            $travel->save();

            $response['status']        = "success";
            $response['message']       = "Traveller Information saved Successfully";
        } else {
            $errors              = $validation->errors()->all();
            $err                 = '';
            foreach($errors as $val) {
                $err               = $err.$val."<br>";
            }
          $response['message'] = $err;
      }
      return response()->json($response);
    }
}
