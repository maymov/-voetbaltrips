<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tournaments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'start_date', 'end_date'];

    public function competition_seating(){
        return $this->belongsTo('App\Competition_seating');
    }

    public function matches() {
        return $this->belongsTo('App\Match');
    }

	public function getTranslate() {
		return $this->hasMany('App\TransTournament', 'tournament_id');
	}
}