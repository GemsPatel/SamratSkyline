<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->id();
            $table->string('class_name')->comment('	controller(class) name of module');
            $table->integer('parent_id')->comment('as a reference menu');
            $table->string('name')->comment('name to be displayed in menu');
            $table->string('slug')->comment('use for url or side bar menu');
            $table->string('icon')->comment('menu icon to be used');
            $table->tinyInteger('status')->comment('0: Disabled, 1: Enabled')->default('0');
            $table->tinyInteger('sort_order')->comment('move admin menu place order');
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
        Schema::dropIfExists('admin_menus');
    }
}
