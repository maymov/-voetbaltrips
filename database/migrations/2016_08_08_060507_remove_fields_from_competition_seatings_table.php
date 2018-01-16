<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsFromCompetitionSeatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competition_seatings', function ($table) {
            $table->renameColumn("category", "seatingcategory_id");
        });
        Schema::table('competition_seatings', function (Blueprint $table) {
            if(Schema::hasColumn("competition_seatings", "image")){
	            $table->dropColumn("image");
            }
            if(Schema::hasColumn("competition_seatings", "home_club")){
                $table->dropColumn("home_club");
            }
            if(Schema::hasColumn("competition_seatings", "away_club")){
                $table->dropColumn("away_club");
            }
            if(Schema::hasColumn("competition_seatings", "tournament_id")){
                $table->dropColumn("tournament_id");
            }
            if(Schema::hasColumn("competition_seatings", "club_id")){
                $table->dropColumn("club_id");
            }
            if(Schema::hasColumn("competition_seatings", "stadium_id")){
                $table->dropColumn("stadium_id");
            }
            $table->integer("matches_id")->after("id");

            $table->integer("seatingcategory_id")->after("matches_id")->change();
            $table->integer("quantity_available")->change();
            $table->decimal("price", 15,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_seatings', function (Blueprint $table) {
            //
        });
    }
}
