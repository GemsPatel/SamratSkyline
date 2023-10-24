<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->comment('0: Parent, >0: Child for selected ID')->default(0);
            $table->integer('type_id')->comment('Reference for type table');
            $table->integer('title_id')->comment('Reference for title table');
            $table->integer('comment_id')->comment('as a drama, book, or podcast id');
            $table->integer('music_id')->comment('as a drama, book or podcast primary id');
            $table->integer('customer_id')->comment('Reference for Customer table');
            $table->tinyInteger('user_type')->comment('0: User, 1: Customer, 2: Member');
            $table->double('rating')->comment('user rating out of 5');
            $table->text('comment')->comment('user comment description');
            $table->string('ip_address')->comment('user comment location');
            $table->tinyInteger('status')->comment('0: Disabled, 1: Enabled')->default('0');
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
        Schema::dropIfExists('rating_comments');
    }
}
