<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccomodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('accomodations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('city');$table->string('stars');$table->string('high_season_prices');$table->string('low_season_prices');$table->string('options');$table->string('breakfast_price');$table->text('images');$table->text('description');
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
        Schema::drop('accomodations');
    }
}