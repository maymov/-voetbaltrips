<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrdersoptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_options', function (Blueprint $table) {
            $table->integer('quantity')->after("price");
        });
        Schema::table("options", function (Blueprint $table){
           $table->decimal("price", 18,2)->change();
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
