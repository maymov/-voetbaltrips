<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNamesOrdersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   

        Schema::table('orders_accomodation', function (Blueprint $table) {
            $table->dropColumn('processed_text');
        });
        
        DB::statement('ALTER TABLE orders_flight CHANGE processed_text reservation_number VARCHAR(200)'); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('orders_accomodation', function (Blueprint $table) {
            $table->string('processed_text')->after('rooms_days');
        });


        DB::statement('ALTER TABLE orders_flight CHANGE reservation_number processed_text VARCHAR(200)');
    }
}
