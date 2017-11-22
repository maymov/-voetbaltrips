<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTravellerinformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traveller_information', function (Blueprint $table) {
            $table->string("postcode", 50)->after("address");
            $table->integer("nationality")->change();
            $table->integer("city")->after("nationality");
            $table->string("email")->after("phone_number");
            $table->date("passport_validity")->nullable()->change();
            $table->enum("is_updated",['0','1'])->default(0)->comment("to know whether the user updated the travel information or not. 0 means not updated, 1 means updated successfully")->after("passport_document");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traveller_information', function (Blueprint $table) {
            //
        });
    }
}
