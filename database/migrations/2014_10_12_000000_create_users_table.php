<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->comment('define user role');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_number')->comment('user contact details');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('csrf')->comment('user password csrf');
            $table->tinyInteger('status')->comment('0: Deactivate, 1: Activate')->default('0');
            $table->rememberToken();
            $table->timestamps();
            // $table->index('role_id');
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
