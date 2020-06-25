<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Asadullah Al Galib',
            'email' => 'me@galibweb.com',
            'password' => Hash::make('password')
        ]);
    }
}
