<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
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
            [
                'user_name' => 'Administrator',
                'email' => 'administrator@mail.com',
                'password' => Hash::make('secretpassword'),
            ]
        ]);
    }
}
