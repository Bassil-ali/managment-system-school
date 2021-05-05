<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //  $this->call(UsersTableSeeder::class);
        $this->call(NationalitiesTableSeeder::class);

        $this->call(BloodTableSeeder::class);
       
        $this->call(religionTableSeeder::class);

        $this->call(SpecialicationsTableSeeder::class);

        $this->call(GenderTableSeeder::class);

    }
}
