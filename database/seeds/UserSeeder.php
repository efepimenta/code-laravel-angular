<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \CodeProject\Entities\User::truncate();
        factory(\CodeProject\Entities\User::class, 5)->create();//
    }
}
