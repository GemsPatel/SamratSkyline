<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer("parent_id")->comment("reference for parent category id");
            $table->string("title");
            $table->string("slug")->comment('support as browser description purpose');
            $table->text("image");
            $table->tinyInteger("sort_order")->comment("as a display Purpose ordering")->default(0);
            $table->tinyInteger("status")->comment("0: Deactivate, 1: Activate")->default(0);
            $table->timestamps();
            // $table->index('type_id');
            // $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
