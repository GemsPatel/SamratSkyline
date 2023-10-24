<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendeds', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Reference as a user table');
            $table->integer('category_id')->comment('Reference as a category table');
            $table->integer('sub_category_id')->comment('Reference as a category table');
            $table->integer('blog_id')->comment('Reference as a blog table');
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
        Schema::dropIfExists('recommendeds');
    }
}
