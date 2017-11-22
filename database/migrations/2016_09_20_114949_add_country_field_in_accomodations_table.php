<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryFieldInAccomodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accomodations', function (Blueprint $table) {
            $table->integer("country_id")->after("address");
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
            if(Schema::hasColumn("accomodations", "country_id")) {
                $table->dropColumn("country_id");
            }
        });
    }
}
