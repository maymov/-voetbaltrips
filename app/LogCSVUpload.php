<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogCSVUpload extends Model
{
    protected $table = "log_csvupload";
    protected $fillable = ["type", "success_entry", "updated_entry", "fail_entry", "message"];
}
