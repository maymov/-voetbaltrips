<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition_seating extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'competition_seatings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['matches_id', 'seatingcategory_id', 'price', 'quantity_available', 'discount', 'total_price'];
    public function getMatch() {
        return $this->belongsTo('App\Match', 'matches_id');
    }
    public function seatingCategory() {
        return $this->belongsTo('App\SeatingCategory', 'seatingcategory_id');
    }
}