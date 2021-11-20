<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'MS'],
            ['key' => 'school_name', 'value' => 'Bassil International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-03-2022'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'الخرطوم'],
            ['key' => 'school_email', 'value' => 'baselali337@gmail.com'],
            ['key' => 'logo', 'value' => 'logo.png'],
        ];

        DB::table('settings')->insert($data);
    }
}
