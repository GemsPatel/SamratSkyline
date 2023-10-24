<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Gautam',//Str::random(10),
            'email' => 'gautam@mailinator.com',
            'mobile_number' => rand( 111111111, 999999999 ),
            'password' => Hash::make('password'),
            'csrf' =>'password',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}