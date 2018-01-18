<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_accomodation', function (Blueprint $table) {
            $table->increments("id");
            $table->string("hotel_name");
            $table->string("star");
            $table->text("address");
            $table->string("city");
            $table->string("country");
            $table->decimal("price", 15,2);
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
        Schema::drop('orders_accomodation');
    }
}
