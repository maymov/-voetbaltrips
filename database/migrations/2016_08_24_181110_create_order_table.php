<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("users_id");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("gender");
            $table->string("country");
            $table->string("state");
            $table->string("city");
            $table->text("address");
            $table->string("postal");
            $table->integer("payment_method");
            $table->integer("payment_status");
            $table->integer("order_status");
            $table->decimal("order_total", 15,2);
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
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
