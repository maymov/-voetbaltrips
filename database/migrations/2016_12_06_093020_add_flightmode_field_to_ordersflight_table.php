<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFlightmodeFieldToOrdersflightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_flight', function (Blueprint $table) {
            $table->enum("flightmode", ['1','2'])->after("orders_id")->comment("to know the flight is inbound or outbound. 1 means outbound and 2 means return");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_flight', function (Blueprint $table) {
            //
        });
    }
}
