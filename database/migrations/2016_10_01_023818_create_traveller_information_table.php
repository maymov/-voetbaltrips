<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravellerInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traveller_information', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("order_id");
            $table->string("name");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("	country_text");
            $table->string("	city_text");
            $table->text("address");
            $table->string("phone_number", 20);
            $table->date("date_of_birth");
            $table->char("gender", 7);
            $table->string("nationality");
            $table->string("identity_type");
            $table->text("passport_number");
            $table->date("passport_validity");
            $table->text("passport_document");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('traveller_information');
    }
}
