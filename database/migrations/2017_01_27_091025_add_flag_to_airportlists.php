<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlagToAirportlists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('airportlists', function (Blueprint $table) {
            $table->enum("showinsearch", [0,1])->default(0)->after("iata_code")->comment("to set the flag from the admin panel that whether this airport is need to show in search dropdown or not");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('airportlists', function (Blueprint $table) {

        });
    }
}
