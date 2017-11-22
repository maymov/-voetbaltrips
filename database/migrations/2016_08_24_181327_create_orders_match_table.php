<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_match', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("orders_id");
            $table->string("country");
            $table->string("city");
            $table->string("tournament");
            $table->string("stadium");
            $table->string("home_club");
            $table->string("away_club");
            $table->dateTime("match_date");
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
        Schema::drop('orders_match');
    }
}
