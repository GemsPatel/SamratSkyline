<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('Reference as a user table');
            $table->integer('category_id')->comment('Reference as a category table');
            $table->string('title')->comment('Slider name');
            $table->string('slug')->comment('URL alias');
            $table->string('image')->comment('Slider image')->nullable();
            $table->text('short_description')->comment('Reference as a meta description');
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
        Schema::dropIfExists('sliders');
    }
}
