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
         $this->call(UsersTableSeeder::class);
         $this->call(UserRightsSeeder::class);
         $this->call(PCCategorySeeder::class);
         $this->call(NeedsSeeder::class);
        $this->call(LocationSeeder::class);

    }
}
