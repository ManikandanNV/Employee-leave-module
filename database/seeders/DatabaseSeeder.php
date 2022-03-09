<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        //Creating hr login
        DB::table('users')->insert([
            'name' => 'HR hulkapps',
            'email' => 'hrhulkapps'.'@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'hr',
        ]);
    }
}
