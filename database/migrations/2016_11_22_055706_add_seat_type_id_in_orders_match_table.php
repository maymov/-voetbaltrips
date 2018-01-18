<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeatTypeIdInOrdersMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_match', function (Blueprint $table) {
            $table->integer("seat_type")->after("matches_id")->comment("to know the seat type. Table reference is competition_seatings");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_match', function (Blueprint $table) {
            //
        });
    }
}
