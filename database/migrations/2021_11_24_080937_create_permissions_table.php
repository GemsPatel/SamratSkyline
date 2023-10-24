<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id')->comment('admin menu id');
            $table->integer('user_id')->comment('admin user/access id');
            $table->integer('role_id')->comment('admin role access id');
            $table->tinyInteger('add')->comment('only user add permission');
            $table->tinyInteger('edit')->comment('only user edit permission');
            $table->tinyInteger('delete')->comment('only user delete permission');
            $table->tinyInteger('view')->comment('only user view permission');
            $table->timestamps();
            // $table->index('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
