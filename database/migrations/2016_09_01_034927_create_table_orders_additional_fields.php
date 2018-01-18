<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrdersAdditionalFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_additional_data', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("orders_id");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("gender");
            $table->text("passport_number");
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
        Schema::table('orders_additional_data', function (Blueprint $table) {
            //
        });
    }
}
