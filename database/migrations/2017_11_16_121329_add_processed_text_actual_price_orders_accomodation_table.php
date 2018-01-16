<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcessedTextActualPriceOrdersAccomodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_accomodation', function (Blueprint $table) {
            $table->string('processed_text')->after('rooms_days');
            $table->integer('actual_price')->after('processed_text');
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
            $table->dropColumn('processed_text');
            $table->dropColumn('actual_price');
        });
    }
}
