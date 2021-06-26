<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'position_id' => 1,
            'region_id' => 1,
            'name' => 'admin',
            'surname' => 'admin',
            'position_name' => 'admin',
            'work_place' => 'Tbilisi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'approve' => true,
            'active' => true
        ]);
    }
}
