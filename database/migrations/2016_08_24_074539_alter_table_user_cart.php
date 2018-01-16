<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_cart', function (Blueprint $table) {
            if(Schema::hasColumn("users_cart", "options")){
                $table->dropColumn("options");
            }
            $table->string("type")->after("price");
            $table->integer("identifier")->after("type");
            $table->integer("match_id")->after("identifier");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_cart', function (Blueprint $table) {
            //
        });
    }
}
