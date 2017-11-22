<?php

use Illuminate\Database\Seeder;
use App\OrdersStatus;
class OrdersStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrdersStatus::truncate();
        OrdersStatus::create(["name" => "Pending"]);
        OrdersStatus::create(["name" => "Processing"]);
        OrdersStatus::create(["name" => "Completed"]);
    }
}
