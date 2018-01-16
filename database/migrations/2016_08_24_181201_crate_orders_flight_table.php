<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateOrdersFlightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_flight', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("orders_id");
            $table->integer("airlines_id");
            $table->string("airlines_name");
            $table->string("flight_number");
            $table->string("departure_airport");
            $table->string("arrival_airport");
            $table->string("via");
            $table->date("departure_date");
            $table->time("departure_time");
            $table->date("arrive_date");
            $table->time("arrive_time");
            $table->string("duration");
            $table->decimal("price",15,2);
            $table->integer("quantity");
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
        Schema::drop('orders_flight');
    }
}
