<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_options', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("orders_id");
            $table->integer("options_id");
            $table->string("title");
            $table->text("description");
            $table->decimal('price', 18,2);
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
        Schema::table('orders_options', function (Blueprint $table) {
            //
        });
    }
}
