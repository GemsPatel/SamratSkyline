<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tag name');
            $table->string('slug')->comment('URL alias');
            $table->string('image')->comment('Tag image')->nullable();
            $table->string('short_description')->comment('Reference as a meta description');
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
        Schema::dropIfExists('tags');
    }
}
