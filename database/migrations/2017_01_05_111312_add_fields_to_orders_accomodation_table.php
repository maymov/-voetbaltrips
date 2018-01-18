<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOrdersAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_accomodation', function (Blueprint $table) {
            if(Schema::hasColumn("orders_accomodation", "orders_match_id")) {
                $table->removeColumn("orders_match_id");
            }
            $table->enum("include_breakfast", ["yes", "no"])->after("quantity");
            $table->decimal("breakfast_price", 15,2)->after("include_breakfast")->nullable();
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
