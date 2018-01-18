<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('flights', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('airlines_id');$table->string('flight_number');$table->string('from');$table->string('to');$table->string('departure_date');$table->string('departure_time');$table->string('arrive_time');$table->string('duration');$table->string('price');$table->string('currency');
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
        Schema::drop('flights');
    }
}