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
                'user_name' => 'Ramon',
                'user_email' => 'ramonangulo@mail.com',
                'user_password' => Hash::make('secret'),
            ]
        ]);
    }
}
