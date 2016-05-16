<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeProject\Entities\Client::truncate();
        factory(\CodeProject\Entities\Client::class, 10)->create();
    }
}
