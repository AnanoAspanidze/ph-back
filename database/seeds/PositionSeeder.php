<?php

use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'id' => 1,
                'active' => true
            ],
            [
                'id' => 2,
                'active' => true
            ],
            [
                'id' => 3,
                'active' => true
            ]
        ]);

        DB::table('position_translations')->insert([
            [
                'position_id' => 1,
                'locale' => 'ka',
                'name' => 'მენეჯერი'
            ],
            [
                'position_id' => 1,
                'locale' => 'en',
                'name' => 'Manager'
            ],
            [
                'position_id' => 1,
                'locale' => 'ru',
                'name' => 'Менеджер'
            ],
            [
                'position_id' => 2,
                'locale' => 'ka',
                'name' => 'პროგრამისტი'
            ],
            [
                'position_id' => 2,
                'locale' => 'en',
                'name' => 'Programmer'
            ],
            [
                'position_id' => 2,
                'locale' => 'ru',
                'name' => 'Програмист'
            ],
            [
                'position_id' => 3,
                'locale' => 'ka',
                'name' => 'ტესტერი'
            ],
            [
                'position_id' => 3,
                'locale' => 'en',
                'name' => 'Tester'
            ],
            [
                'position_id' => 3,
                'locale' => 'ru',
                'name' => 'Тестер'
            ],
        ]);
    }
}
