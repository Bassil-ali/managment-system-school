<?php

use Illuminate\Database\Seeder;
use App\Models\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::create([
            'name' => 'bassil ali',
            'email' => 'bassilali811@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
