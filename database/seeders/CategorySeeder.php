<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            ['id' => 1, 'parent_id' => '0', 'title' => 'Goal', 'slug' => 'goal', 'image' => 'public/category/Goal.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'parent_id' => '0', 'title' => 'Life', 'slug' => 'life', 'image' => 'public/category/Life.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'parent_id' => '0', 'title' => 'Motivation', 'slug' => 'motivation', 'image' => 'public/category/Motivation.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'parent_id' => '0', 'title' => 'Leadership', 'slug' => 'leadership', 'image' => 'public/category/Leadership.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'parent_id' => '0', 'title' => 'Brain Power', 'slug' => 'brain-power', 'image' => 'public/category/Brain-Power.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'parent_id' => '0', 'title' => 'Health', 'slug' => 'health', 'image' => 'public/category/Health.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'parent_id' => '0', 'title' => 'Fitness', 'slug' => 'fitness', 'image' => 'public/category/Fitness.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'parent_id' => '0', 'title' => 'Energy', 'slug' => 'energy', 'image' => 'public/category/Energy.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'parent_id' => '0', 'title' => 'Wellness', 'slug' => 'wellness', 'image' => 'public/category/Wellness.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'parent_id' => '0', 'title' => 'Relationship', 'slug' => 'relationship', 'image' => 'public/category/Relationship.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'parent_id' => '0', 'title' => 'Parenting', 'slug' => 'parenting', 'image' => 'public/category/Parenting.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'parent_id' => '0', 'title' => 'Entrepreneur', 'slug' => 'entrepreneur', 'image' => 'public/category/Entrepreneur.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'parent_id' => '0', 'title' => 'Happiness', 'slug' => 'happiness', 'image' => 'public/category/Happiness.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'parent_id' => '0', 'title' => 'Lifehack', 'slug' => 'lifehack', 'image' => 'public/category/Lifehack.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'parent_id' => '0', 'title' => 'Technology', 'slug' => 'technology', 'image' => 'public/category/Technology.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'parent_id' => '0', 'title' => 'Sport', 'slug' => 'sport', 'image' => 'public/category/Sport.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'parent_id' => '0', 'title' => 'Business', 'slug' => 'business', 'image' => 'public/category/Business.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'parent_id' => '0', 'title' => 'Politics', 'slug' => 'politics', 'image' => 'public/category/Politics.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'parent_id' => '0', 'title' => 'Science', 'slug' => 'science', 'image' => 'public/category/Science.png', 'status' => 1, 'sort_order' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
