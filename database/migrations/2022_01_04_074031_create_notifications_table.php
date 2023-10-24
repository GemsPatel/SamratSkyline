<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('message')->comment('customer notification message');
            $table->string('title')->comment('customer notification title');
            $table->tinyInteger('status')->comment('0: Disabled, 1: Enabled')->default(0);
            $table->string('image')->comment('Push notification image')->nullable();
            $table->tinyInteger('is_android_send')->comment('1: Send, 0: Waiting')->default(0);
            $table->tinyInteger('is_ios_send')->comment('1: Send, 0: Waiting')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
