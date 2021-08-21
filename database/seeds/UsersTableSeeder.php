<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'bassil ali',
            'email' => 'bassilali811@gmail.com',
            'password' => bcrypt('12345678')
        ]);
    }
}
