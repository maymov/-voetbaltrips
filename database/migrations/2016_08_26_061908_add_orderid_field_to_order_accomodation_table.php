<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderidFieldToOrderAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("orders_accomodation", function(Blueprint $table){
            $table->integer("orders_id")->after("id");
            $table->integer("orders_match_id")->after("orders_id")->comment("to connect accomodation is related to which match order");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("orders_accomodation", function(Blueprint $table){
           if(Schema::hasColumn("orders_accomodation", "orders_id")){
               $table->dropColumn("orders_id");
           }
        });
    }
}
