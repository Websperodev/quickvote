<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255)->nullable();
            $table->integer('state_id')->nullable();
            $table->string('state_code', 255)->nullable();
            $table->integer('country_id')->nullable();
            $table->string('country_code', 255)->nullable();
            $table->string('latitude', 255);
            $table->string('longitude', 255)->nullable();
            $table->string('flag', 255)->nullable();
            $table->string('wikiDataId', 255)->nullable();
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
        Schema::dropIfExists('cities');
    }
}
