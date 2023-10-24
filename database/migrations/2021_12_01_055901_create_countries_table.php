<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('sortname')->default(null);
            $table->string('name')->comment('Country Name');
            $table->string('symbol')->comment('Country Currency Symbol')->default(null);
            $table->string('code')->comment('Country Code')->default(0);
            $table->string('image')->comment('Country flag')->nullable();
            $table->tinyInteger("status")->comment("0: Deactivate, 1: Activate")->default('0');
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
        Schema::dropIfExists('countries');
    }
}
