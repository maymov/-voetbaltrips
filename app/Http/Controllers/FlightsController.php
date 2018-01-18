<?php namespace App\Http\Controllers;

use App\Cities;
use App\Country;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Flight;
use App\LogCSVUpload;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use App\Airlines;
use App\Airportlist;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Validator;
use App\Jobs\UploadFlightCSV;
class FlightsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $flights = Flight::paginate(20);
		return view('admin.flights.index', compact('flights'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$airports = Airportlist::lists("title", "id");
		$airlines = Airlines::lists("name", "id"); 
		return view('admin.flights.create', ["airports" => $airports, "airlines" => $airlines ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $data = $request->all();
        $created = new Carbon(date('Y-m-d', strtotime($data['departure_date']))." ".date('H:i:s', strtotime($data['departure_time'])));
        $now = new Carbon(date('Y-m-d', strtotime($data['arrive_date']))." ".date('H:i:s', strtotime($data['arrive_time'])));
        $difference = $created->diff($now)->format('%h h %I');
        $data['duration']    = $difference;
        flight::create($data);
		return redirect('admin/flights')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$flight = Flight::findOrFail($id);
		return view('admin.flights.show', compact('flight'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$flight = Flight::findOrFail($id);
        $airports = Airportlist::lists("title", "id");
        $airlines = Airlines::lists("name", "id");
        return view('admin.flights.edit', compact('flight', 'airports', 'airlines'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$flight = Flight::findOrFail($id);
        $data = $request->all();
        $created = new Carbon(date('Y-m-d', strtotime($data['departure_date']))." ".date('H:i:s', strtotime($data['departure_time'])));
        $now = new Carbon(date('Y-m-d', strtotime($data['arrive_date']))." ".date('H:i:s', strtotime($data['arrive_time'])));
        $difference = $created->diff($now)->format('%h h %I');
        $data['duration']    = $difference;
		$flight->update($data);
		return redirect('admin/flights')->with('success', Lang::get('message.success.update'));
	}

	/**
     * Delete confirmation for the given Flight.
     *
     * @param  int      $id
     * @return View
     */
    public function getModalDelete($id = null)
    {
        $error = '';
        $model = '';
        $confirm_route =  route('admin.flights.delete',['id'=>$id]);
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    }

    /**
     * Delete the given Flight.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function getDelete($id = null)
    {
        $flight = Flight::destroy($id);

        // Redirect to the group management page
        return redirect('admin/flights')->with('success', Lang::get('message.success.delete'));

    }
    /**
     * Importing the flight data from the CSV
     * It is an ajax function
     * when the admin save the data from csv
     * before importing the data from the csv the table truncates
     */
    public function importFlightCsv(Request $request){
        $resp['status']   = "error";
        $resp['message']  = "Unable to upload Import file";
        $rules = [
            "csvfile"    => "required|mimes:'application/vnd.ms-excel','text/plain','text/csv','text/tsv'",
            "flighttype" => "required"
        ];
        $validator        = Validator::make($request->all(), $rules);
        if($validator->valid()) {
            /**
             * Moving file
             */
            if(!file_exists(public_path()."/uploads/temp")){
                mkdir(public_path()."/uploads/temp",755);
            }
            $image     = $request->file("csvfile");
            $filename  = md5(uniqid(rand(), true)).str_random().time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path()."/uploads/temp", $filename);
            $resp['status']  = "success";
            $resp['message'] = "The data will be upload in the background. You can see the result in log.";
            $job = (new UploadFlightCSV($filename, $request->input("flighttype")))->onQueue('flightupload');
            $this->dispatch($job);
        } else {
            $resp['message'] = "Please upload a valid CSV file";
        }
        return response()->json($resp);
    }
    public function getAirportDetails($airport) {
        $text = $airport;
        preg_match_all('#\((.*?)\)#', $text, $match);
        $resp_data['status'] = "error";
        foreach ($match[1] as $airportcode_match){
            if(strlen($airportcode_match) == 3) {
                /**
                 * Checking that airport is exist in the database
                 */
                $airport_check = Airportlist::where("iata_code","=", $airportcode_match)->first();
                if ($airport_check === null) {
                    // airport doesn't exist
                    $client      = new \GuzzleHttp\Client([
                        'headers' => [
                            'Accept'        => 'application/json',
                            'X-Mashape-Key' => 'tUT9ZoA9AWmsh4nTwY7mt8OaDQBep1bQ724jsnqXWlzvVJXrKI'
                        ]
                    ]);
                    $res         = $client->request('GET', 'https://cometari-airportsfinder-v1.p.mashape.com/api/airports/by-code?code='.$airportcode_match);
                    $response    = $res->getBody();
                    $result      = \GuzzleHttp\json_decode($response, true);
                    if(isset($result) and !empty($result)) {
                        $airportdata = $result[0];
                        /**
                         * Here check that this airport is exist in the data base
                         * if it exist then just take the is
                         * if the airport is not exist then create the new entry and return the airport id code
                         */
                        $country_code = Country::where("code", "=", $airportdata['countryCode'])->first();
                        $city_code    = Cities::firstOrCreate([
                            "name"    => ((!empty($airportdata['city']))? $airportdata['city'] : $airportdata['name']),
                            "country_id" => $country_code->id
                        ]);
                        $airport_create = Airportlist::create([
                            "country_id" => $country_code->id,
                            "city_id"    => $city_code->id,
                            "title"      => $airport,
                            "iata_code"  => $airportcode_match
                        ]);
                        $resp_data['status']     = "success";
                        $resp_data['airport_id'] = $airport_create->id;
                        return $resp_data;
                    }
                } else {
                    $resp_data['status']     = "success";
                    $resp_data['airport_id'] = $airport_check->id;
                    return $resp_data;
                }
            }
        }
        return $resp_data;
    }
    public function logCsv()
    {
        $log   = LogCSVUpload::paginate(25);
        return view('admin.flights.log', compact('log'));
    }

    public function getModalEmpty()
    {
        $error = '';
        $model = '';
        $confirm_route =  route('admin.flights.empty');
        return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    }

     public function emptyFlights()
        {
            DB::table('flights')->truncate();
            //Match::truncate();
            return redirect('admin/flights')->with('success', Lang::get('message.empty.empty'));

            
        }
}