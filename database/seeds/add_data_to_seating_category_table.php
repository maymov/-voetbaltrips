<?php
use Illuminate\Database\Seeder;
use App\SeatingCategory;
class add_data_to_seating_category_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("seatingcategory")->truncate();
        SeatingCategory::create(["name"  => "Platinum"]);
        SeatingCategory::create(["name"  => "Gold"]);
        SeatingCategory::create(["name"  => "Silver"]);
    }
}