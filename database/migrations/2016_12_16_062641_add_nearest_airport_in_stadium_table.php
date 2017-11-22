<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNearestAirportInStadiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stadia', function (Blueprint $table) {
            $table->integer("nearest_airport")->after("city")->comment("to know which airport is nearest to the stadium");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stadia', function (Blueprint $table) {
            //
        });
    }
}
