<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('invoice_lines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('invoice_id');$table->integer('product_id');$table->string('product_title');$table->integer('product_amount');$table->string('product_vat');$table->string('product_price');
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
        Schema::drop('invoice_lines');
    }
}