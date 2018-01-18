<?php

use Illuminate\Database\Seeder;
use App\Cities;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Remove the all entries in the cities table
         */
        DB::table("cities")->truncate();
        Cities::create(['name' => "Emmen", "country_id" => 152]);
        Cities::create(['name' => "Amsterdam", "country_id" => 152]);
        Cities::create(['name' => "Rotterdam", "country_id" => 152]);
        Cities::create(['name' => "The Hague", "country_id" => 152]);
        Cities::create(['name' => "Utrecht", "country_id" => 152]);
        Cities::create(['name' => "Eindhoven", "country_id" => 152]);
        Cities::create(['name' => "Tilburg", "country_id" => 152]);
        Cities::create(['name' => "Groningen", "country_id" => 152]);
        Cities::create(['name' => "Almere Stad", "country_id" => 152]);
        Cities::create(['name' => "Breda", "country_id" => 152]);
        Cities::create(['name' => "Nijmegen", "country_id" => 152]);
        Cities::create(['name' => "Enschede", "country_id" => 152]);
        Cities::create(['name' => "Haarlem", "country_id" => 152]);
        Cities::create(['name' => "Zaanstad", "country_id" => 152]);
        Cities::create(['name' => "Arnhem", "country_id" => 152]);
        Cities::create(['name' => "Apeldoorn", "country_id" => 152]);
        Cities::create(['name' => "Hoofddorp", "country_id" => 152]);
        Cities::create(['name' => "Maastricht", "country_id" => 152]);
        Cities::create(['name' => "Leiden", "country_id" => 152]);
        Cities::create(['name' => "Zoetermeer", "country_id" => 152]);
        Cities::create(['name' => "Dordrecht", "country_id" => 152]);
        Cities::create(['name' => "Zwolle", "country_id" => 152]);
        Cities::create(['name' => "Deventer", "country_id" => 152]);
    }
}
