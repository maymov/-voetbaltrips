<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcessedTextActualPriceOrdersMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_match', function (Blueprint $table) {
            $table->string('processed_text')->after('quantity');
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
        Schema::table('orders_match', function (Blueprint $table) {
            $table->dropColumn('processed_text');
            $table->dropColumn('actual_price');
        });
    }
}
