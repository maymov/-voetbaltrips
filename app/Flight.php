<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Airlines;
use Illuminate\Support\Facades\DB;
class Flight extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table    = 'flights';
    public $timestamps  = true;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['flightmode','airlines_id', 'flight_number', 'from', 'to', 'via', 'departure_date', 'departure_time', 'arrive_date', 'arrive_time', 'duration', 'price', 'currency'];
    public function airline() {
       return $this->belongsTo('App\Airlines', 'airlines_id');
    }
    public function source_airport() {
        return $this->belongsTo('App\Airportlist', 'from');
    }
    public function destination_airport() {
        return $this->belongsTo('App\Airportlist', 'to');
    }
    public function getAirports($city = null, $arrive_date = null) {
        return DB::table('flights')
            ->join('airports', 'airports.id', '=', 'flights.to')
            ->where("airports.cities_id", "=", $city)
            /*->where("flights.arrive_date", "<=", $arrive_date)*/
            ->where("flights.departure_date", ">=", date('Y-m-d'))
            ->select('flights.*', 'airports.*')
            ->orderby("flights.departure_date", "asc")
            ->get();
    }
}