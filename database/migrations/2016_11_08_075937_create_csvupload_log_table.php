<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCsvuploadLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_csvupload', function (Blueprint $table) {
            $table->increments("id");
            $table->tinyInteger("type")->comment("1 means flight upload, 2 means matches upload");
            $table->bigInteger("success_entry")->comment("number of records inserted to the table");
            $table->bigInteger("fail_entry")->comment("number of failed records");
            $table->text("message")->comment("about the csv upload result");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('log_csvupload');
    }
}
