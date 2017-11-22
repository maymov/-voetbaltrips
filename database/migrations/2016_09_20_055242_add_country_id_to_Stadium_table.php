<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryIdToStadiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stadia', function (Blueprint $table) {
            $table->integer("country_id")->after("stadium");
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
            if(Schema::hasColumn("stadia", "country_id")) {
                $table->dropColumn("country_id");
            }
        });
    }
}
