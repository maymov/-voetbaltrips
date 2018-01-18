<?php

use Illuminate\Database\Seeder;
use App\TicketType;
class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketType::create(["name"=>"Match"]);
        TicketType::create(["name"=>"Flight"]);
        TicketType::create(["name"=>"Room"]);
    }
}
