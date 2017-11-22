<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTypeofticketToOrdersMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_match', function (Blueprint $table) {
            $table->string("seating_type")->after("match_date");
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
            if(Schema::hasColumn("orders_match", "seating_type")) {
                $table->dropColumn("orders_match");
            }
        });
    }
}
