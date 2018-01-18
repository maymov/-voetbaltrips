<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransMails extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table    = 'mail_trans';
	public $timestamps  = false;

	protected $fillable = ['mail_id', 'lang_code', 'title', 'text'];

}
