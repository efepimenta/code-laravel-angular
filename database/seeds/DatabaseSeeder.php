<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProjectNoteSeeder::class);
    }
}
