<?php namespace App;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends EloquentUser {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes to be fillable from the model.
	 *
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	* To allow soft deletes
	*/
	use SoftDeletes;

    protected $dates = ['deleted_at'];

	/**
	 * Get the clients for the user.
	 */
	public function clients()
	{
		return $this->hasMany('App\Client');
	}

	/**
	 * Get the companies for the user.
	 */
	public function companies()
	{
		return $this->hasMany('App\Company');
	}
}
