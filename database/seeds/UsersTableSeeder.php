<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =
            [

            'role_name'  => 'user',
            'name'       => 'User 1',
            'email'      => 'user@example.com',
            'mobile'     => '1234567890',
            'password'   => Hash::make('123456'), //hashes our password nicely for us
            'user_funds' => 500,
            'status'     => 1,

        ];
        $admin = [
            'role_name'  => 'admin',
            'name'       => 'Admin 1',
            'email'      => 'admin@example.com',
            'mobile'     => '1234567890',
            'password'   => Hash::make('123456'), //hashes our password nicely for us,
            'user_funds' => 500,
            'status'     => 1,
        ];
        User::create($user);
        User::create($admin);
    }
}
