<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'client_nr', 'name', 'email', 'phone', 'mobile', 'address_1', 'address_2', 'city', 'state', 'postal_code', 'country', 'website', 'notes'];

    public function user()
    {
        return $this->belongsToOne('App\User');
    }
}