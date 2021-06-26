<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
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

        DB::table('region_translations')->insert([
            [
                'region_id' => 1,
                'locale' => 'ka',
                'name' => 'ევროპა'
            ],
            [
                'region_id' => 1,
                'locale' => 'en',
                'name' => 'Europe'
            ],
            [
                'region_id' => 1,
                'locale' => 'ru',
                'name' => 'Европа'
            ],
            [
                'region_id' => 2,
                'locale' => 'ka',
                'name' => 'აზია'
            ],
            [
                'region_id' => 2,
                'locale' => 'en',
                'name' => 'Asia'
            ],
            [
                'region_id' => 2,
                'locale' => 'ru',
                'name' => 'Азия'
            ],
            [
                'region_id' => 3,
                'locale' => 'ka',
                'name' => 'ამერიკა'
            ],
            [
                'region_id' => 3,
                'locale' => 'en',
                'name' => 'America'
            ],
            [
                'region_id' => 3,
                'locale' => 'ru',
                'name' => 'Америка'
            ],

        ]);
    }
}
