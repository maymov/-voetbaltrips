<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $this->call('AdminSeeder');
        // $this->call('CitiesSeeder');
        $this->call("CountryTableSeeder");
        //$this->call("add_data_to_seating_category_table");
        $this->call("OrdersStatusTableSeeder");
        $this->call("TicketTypeSeeder");
        $this->call("PaymentStatusSeeder");
        Model::reguard();
    }
}
