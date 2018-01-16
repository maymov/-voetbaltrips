<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mails extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table    = 'mails';
	public $timestamps  = false;

	protected $fillable = ['name'];

	public function getTranslate() {
		return $this->hasMany('App\TransMails', 'mail_id');
	}
}
