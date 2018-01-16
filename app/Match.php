<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'matches';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tournament', 'stadium', 'home_club', 'away_club', 'match_date', 'image_name', 'fixed_data'];

    public function getCountry() {
        return $this->belongsTo('App\Country', 'country');
    }

    public function getCity() {
        return $this->belongsTo('App\Cities', 'city');
    }

    public function getStadium() {
        return $this->belongsTo('App\Stadium', 'stadium');
    }
    public function getHomeClub() {
        return $this->belongsTo('App\Club', 'home_club');
    }
    public function getAwayClub() {
        return $this->belongsTo('App\Club', 'away_club');
    }

    public function getTournament() {
        return $this->belongsTo('App\Tournament', 'tournament');
    }
    public function competitionSeatingGet(){
        return $this->hasMany('App\Competition_seating', 'matches_id', 'id')->where('price', '>', 0)->orderBy('price', 'asc');
    }
    public function ordersMatch(){
        return $this->hasMany('App\OrderMatch','matches_id');
    }
}