<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Reference as a user table');
            $table->integer('category_id')->comment('Reference as a category table');
            $table->integer('sub_category_id')->comment('Reference as a category table');
            $table->string('title')->comment('blog name');
            $table->string('slug')->comment('URL alias');
            $table->string('image')->comment('Blog image')->nullable();
            $table->string('podcast_url')->comment('Youtube or other video content URL')->nullable();
            $table->text('short_description')->comment('Reference as a meta description');
            $table->longText('description')->comment('HTML content or read file name ');
            $table->integer('view')->comment('total view')->default(0);
            $table->tinyInteger('status')->comment('0: Deactivate, 1: Activate')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
