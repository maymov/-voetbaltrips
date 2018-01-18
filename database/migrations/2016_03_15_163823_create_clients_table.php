<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('clients', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');$table->integer('client_nr');$table->string('name');$table->string('email');$table->string('phone');$table->string('mobile');$table->string('address_1');$table->string('address_2');$table->string('city');$table->string('state');$table->string('postal_code');$table->string('country');$table->string('website');$table->text('notes');
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
        Schema::drop('clients');
    }
}