<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'guard_name' => 'web', 'name' => 'admin'],
            ['id' => 2, 'guard_name' => 'web', 'name' => 'teacher'],
            ['id' => 3, 'guard_name' => 'web', 'name' => 'student'],                
        ]);

        DB::table('model_has_roles')->insert([
            ['role_id' => 1, 'model_type' => 'App\User', 'model_id' => 1],
        ]);
    }
}
