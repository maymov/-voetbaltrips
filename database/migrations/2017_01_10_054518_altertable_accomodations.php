<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableAccomodations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accomodations', function (Blueprint $table) {
            $table->integer("city")->change();
            $table->integer("stars")->change();
            $table->decimal("high_season_prices", 15,2)->change();
            $table->decimal("low_season_prices", 15,2)->change();
            $table->text("options")->change();
            $table->decimal("breakfast_price", 15,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accomodations', function (Blueprint $table) {
            //
        });
    }
}
