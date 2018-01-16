<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['admin_user_id', 'name', 'active'];

    public function user()
    {
        return $this->belongsToOne('App\User');
    }
}