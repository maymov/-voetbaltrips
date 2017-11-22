<?php

namespace App\Jobs;

use App\Http\Controllers\FlightsController;
use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Airlines;
use App\Flight;
use Maatwebsite\Excel\Facades\Excel;
use App\LogCSVUpload;
class UploadFlightCSV extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filename;
    protected $flighttype;
    public function __construct($filename, $type)
    {
        $this->filename   = $filename;
        $this->flighttype = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = Excel::load(public_path()."/uploads/temp/".$this->filename, function($reader) {
		$reader->setDelimiter(',');
        })->get();

	$updatedEntries = 0;

        if(!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {

                /**
                 * Checking with the details of all are exist in the table
                 */
                /**
                 * Checking airlines is already added
                 * If the airline is already added then take its id from the table
                 * If the airline is not saved then save the airline
                 * destination and source must be save like the same situation
                 */

//                foreach ($value as $k => $val) {

	                //$v = explode(",", $val); //delimiter "," does not work
                        $v = array_values($value->toArray());

	                $airlines        = Airlines::firstOrCreate(['name' => $v[0]]);
	                if (!$airlines) {dd($value);}
	                $airlines_id     = $airlines->id;
	                $from_airport    = app('App\Http\Controllers\FlightsController')->getAirportDetails($v[1]);
	                $to_airport      = app('App\Http\Controllers\FlightsController')->getAirportDetails($v[2]);
	                $from_airport_id = (($from_airport['status'] == 'success')? $from_airport['airport_id']:'');
	                $to_airport_id   = (($to_airport['status'] == 'success')? $to_airport['airport_id']:'');

	                /**
	                 * Calculating arrival date
	                 */

	                $dept_date       = date("Y-m-d", strtotime(trim($v[4],'"')));
	                $dept_time       = date("H:i:s", strtotime(trim($v[5],'"')));
	                $dept_datetime   = date("Y-m-d H:i:s", strtotime($dept_date." ".$dept_time));
	                $dur             = str_replace(' ', '', trim($v[7],'"'));
	                $dur_exp         = explode("h", $dur);
	                $arrive_date     = date('Y-m-d',strtotime("+{$dur_exp[0]} hour +{$dur_exp[1]} minutes",strtotime($dept_datetime)));
	                $arrive_time     = date("H:i:s", strtotime(trim($v[6],'"')));

	                //dd($dept_time, $dept_datetime, $dur, $dur_exp, $arrive_date, $arr_time);
	                /**
	                 * Duplicate entry will be automatically escaped
	                 */
	                $check_flight = Flight::where("airlines_id", $airlines_id)
	                    ->where("from", $from_airport_id)
	                    ->where("to", $to_airport_id)
	                    ->where("via",$value->via)
	                    ->where("departure_date", $dept_date)
	                    ->where("departure_time", $dept_time)
	                    ->first();

	                if ($check_flight) {
	                    if ($check_flight->price != trim($v[8],'"')) {
                                $check_flight->price = trim($v[8],'"');
                                $check_flight->save();
				$updatedEntries++;
                            }
                        }

	                if ($check_flight === null) {
	                    $insert[]        = [
	                        "airlines_id"    => $airlines_id,
	                        "flightmode"     => $this->flighttype,
	                        "from"           => $from_airport_id,
	                        "to"             => $to_airport_id,
	                        "via"            => $v[3],
	                        "departure_date" => $dept_date,
	                        "departure_time" => $dept_time,
	                        "arrive_date"    => $arrive_date,
	                        "arrive_time"    => $arrive_time,
	                        "duration"       => trim($v[7],'"'),
	                        "price"          => trim($v[8],'"'),
	                        "currency"       => trim($v[9],'"'),
	                        "created_at"     => date("Y-m-d H:i:s"),
	                        "updated_at"     => date("Y-m-d H:i:s")
	                    ];
	                }
//                }foreach ($value as $k => $val)
            }

            if (!empty($insert)) {
                foreach (array_chunk($insert,1000) as $t) {

                    Flight::insert($t);
                }
                $log = [
                    "type"          => 1,
                    "success_entry" => count($insert),
                    "updated_entry" => $updatedEntries,
                    "fail_entry"    => (count($data) - count($insert)) - $updatedEntries,
                    "message"       => 'Flight data uploaded Successfully.'
                ];
            } else {
                $log = [
                    "type"          => 1,
                    "success_entry" => 0,
                    "updated_entry" => $updatedEntries,
                    "fail_entry"    => count($data) - $updatedEntries,
                    "message"       => 'There is no new data to import.'
                ];
            }

        } else {
            $log = [
                "type"          => 1,
                "success_entry" => 0,
                "fail_entry"    => 0,
		"updated_entry" => 0,
                "message"       => 'There is no data to Upload'
            ];
        }
        LogCSVUpload::create($log);
        @unlink(public_path()."/uploads/temp/".$this->filename);
    }
}
