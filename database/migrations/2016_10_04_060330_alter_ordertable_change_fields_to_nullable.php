<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrdertableChangeFieldsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string("gender")->nullable()->change();
            $table->string("country")->nullable()->change();
            $table->string("state")->nullable()->change();
            $table->string("city")->nullable()->change();
            $table->text("address")->nullable()->change();
            $table->string("postal")->nullable()->change();
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
