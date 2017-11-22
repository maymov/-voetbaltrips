<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdersMatchTableAddFieldsMatchIdPriceQuantity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_match', function (Blueprint $table) {
            $table->integer("matches_id")->after("orders_id");
            $table->decimal("price", 15,2)->after("match_date");
            $table->integer("quantity")->after("price");
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
