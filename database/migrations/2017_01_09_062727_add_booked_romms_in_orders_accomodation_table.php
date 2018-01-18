<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBookedRommsInOrdersAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_accomodation', function (Blueprint $table) {
            $table->integer("rooms_days")->after("breakfast_price")->comment("to know how many days user want to stay in the hotel");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_accomodation', function (Blueprint $table) {
            //
        });
    }
}
