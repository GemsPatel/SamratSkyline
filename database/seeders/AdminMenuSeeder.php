<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menus')->delete();
        
        DB::table('admin_menus')->insert([
            ['id' => 1, 'class_name' => 'admin.dashboard', 'parent_id' => 0, 'name' => 'Dashboard', 'slug' => 'dashboard', 'icon' => 'fas fa-tachometer-alt', 'status' => 1, 'sort_order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'class_name' => '/', 'parent_id' => 0, 'name' => 'Blogs', 'slug' => 'blogs', 'icon' => 'fa fa-sitemap', 'status' => 1, 'sort_order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'class_name' => 'admin.category', 'parent_id' => 2, 'name' => 'Category', 'slug' => 'category', 'icon' => 'fas fa-list', 'status' => 1, 'sort_order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'class_name' => 'admin.subcategory', 'parent_id' => 2, 'name' => 'Sub Category', 'slug' => 'sub-category', 'icon' => 'fas fa-list', 'status' => 1, 'sort_order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'class_name' => '/', 'parent_id' => 0, 'name' => 'Settings', 'slug' => 'settings', 'icon' => 'fa fa-cog', 'status' => 1, 'sort_order' => 100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'class_name' => 'admin.menu', 'parent_id' => 5, 'name' => 'Menu', 'slug' => 'menu', 'icon' => 'fas fa-bars', 'status' => 1, 'sort_order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'class_name' => 'admin.role', 'parent_id' => 8, 'name' => 'Role', 'slug' => 'role', 'icon' => 'fas fa-road', 'status' => 1, 'sort_order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'class_name' => '/', 'parent_id' => 0, 'name' => 'User Management', 'slug' => 'user-management', 'icon' => 'fa fa-users', 'status' => 1, 'sort_order' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'class_name' => 'admin.user', 'parent_id' => 8, 'name' => 'User', 'slug' => 'user', 'icon' => 'fa fa-user', 'status' => 1, 'sort_order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'class_name' => 'admin.rating-comment', 'parent_id' => 8, 'name' => 'Rating and Comments', 'slug' => 'ratting-comments', 'icon' => 'far fa-comments', 'status' => 1, 'sort_order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'class_name' => 'admin.customer', 'parent_id' => 8, 'name' => 'Customer', 'slug' => 'customer', 'icon' => 'fa fa-user', 'status' => 1, 'sort_order' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'class_name' => 'admin.country', 'parent_id' => 5, 'name' => 'Country', 'slug' => 'country', 'icon' => 'fa fa-map', 'status' => 1, 'sort_order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 23, 'class_name' => 'admin.language', 'parent_id' => 5, 'name' => 'Language', 'slug' => 'language', 'icon' => 'fa fa-language', 'status' => 1, 'sort_order' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 28, 'class_name' => 'admin.notification', 'parent_id' => 5, 'name' => 'Notification', 'slug' => 'notification', 'icon' => 'fa fa-bell', 'status' => 1, 'sort_order' => 10, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 29, 'class_name' => 'admin.configuration', 'parent_id' => 5, 'name' => 'Configuration', 'slug' => 'configuration', 'icon' => 'fa fa-cog', 'status' => 1, 'sort_order' => 15, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 30, 'class_name' => 'admin.update-profile', 'parent_id' => 5, 'name' => 'Update Password', 'slug' => 'update-password', 'icon' => 'fa fa-user-edit', 'status' => 1, 'sort_order' => 20, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}