<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralTask extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'general_tasks';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = ['user_id', 'name', 'date_time'];

    protected $guarded = ['id'];
}