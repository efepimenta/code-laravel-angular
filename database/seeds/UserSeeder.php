<?php

use Illuminate\Database\Seeder;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \CodeProject\Entities\User::truncate();
        factory(\CodeProject\Entities\User::class)->create([
            'name' => 'fabio',
            'email' => 'fabio@email.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);
        
    }
}
