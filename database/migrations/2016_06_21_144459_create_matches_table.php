<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('matches', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('country');$table->string('city');$table->integer('tournament');$table->integer('stadium');$table->integer('home_club');$table->integer('away_club');$table->string('match_date');
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
        Schema::drop('matches');
    }
}