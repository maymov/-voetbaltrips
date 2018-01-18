<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clubs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country', 'city', 'emblem'];
    public function competitionSeatings(){
        return $this->belongsTo('App\Competition_seating');
    }
    public function matches() {
        return $this->belongsTo('App\Match');
    }
    public function getCountry() {
        return $this->belongsTo('App\Country','country');
    }
    public function getCity() {
        return $this->belongsTo('App\Cities', 'city');
    }
	public function getTranslate() {
		return $this->hasMany('App\TransClub', 'club_id');
	}

}