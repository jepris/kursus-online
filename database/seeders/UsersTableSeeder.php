<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jepri',
            'email' => 'jeprisimbolon@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user'
        ],[
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => 'admin123',
            'role' => 'admin'
        ]);
    }
}
