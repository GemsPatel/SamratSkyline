<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        DB::table('permissions')->insert([
            ['id' => 1, 'menu_id' => 1, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'menu_id' => 2, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'menu_id' => 3, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'menu_id' => 4, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'menu_id' => 5, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'menu_id' => 6, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'menu_id' => 7, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'menu_id' => 8, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'menu_id' => 9, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'menu_id' => 14, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'menu_id' => 15, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'menu_id' => 18, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'menu_id' => 23, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'menu_id' => 28, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'menu_id' => 29, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'menu_id' => 30, 'user_id' => 1, 'role_id' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1, 'view' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
