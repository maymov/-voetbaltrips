<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsMimeFilenameToStadiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("stadia", function (Blueprint $table){
            $table->integer("city")->change();
            $table->string("image")->comments("custom file name")->change();
            $table->string("mime")->after("image")->comments("saving mime type of the image for displaying the image");
            $table->string("filename")->after("mime")->comments("Original file name uploaded by the user");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("stadia", function (Blueprint $table){
           if(Schema::hasColumn("stadia", 'mime')){
               $table->dropColumn("mime");
           }
            if(Schema::hasColumn("stadia", 'filename')){
                $table->dropColumn("filename");
            }
        });
    }
}
