<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'locale' => 'ka',
                'name' => 'ქართული',
                'active' => true
            ],
            [
                'locale' => 'en',
                'name' => 'English',
                'active' => true
            ],
            [
                'locale' => 'ru',
                'name' => 'Русский',
                'active' => true
            ]
        ]);
    }
}
