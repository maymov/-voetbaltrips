<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionSeatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('competition_seatings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('image');$table->string('home_club');$table->string('away_club');$table->string('tournament_id');$table->string('category');$table->string('price');$table->string('club_id');$table->string('stadium_id');$table->string('quantity_available');
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
        Schema::drop('competition_seatings');
    }
}