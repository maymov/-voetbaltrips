<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("flights", function(Blueprint $table){
            $table->string("via", 50)->after("to")->nullable();
            $table->date("arrive_date")->after("departure_time");
            $table->integer("airlines_id")->change();
            $table->integer("from")->change();
            $table->integer("to")->change();
            $table->date("departure_date")->change();
            $table->time("departure_time")->change();
            $table->time("arrive_time")->change();
            $table->decimal("price", 15,2)->change();
            $table->string("currency", 4)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("flights", function(Blueprint $table){
            if (Schema::hasColumn('flights', 'arrive_date')) {
                $table->dropColumn("arrive_date");
            }
            if(Schema::hasColumn("flights", "via")){
                $table->dropColumn("via");
            }
        });
    }
}
