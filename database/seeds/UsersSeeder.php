<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        if(!$user) {
            $user = User::create(
                [
                    'name'=>'admin',
                    'email'=>'admin@gmail.com',
                    'password'=> bcrypt("123456")
                ]);
        }
    }
}
