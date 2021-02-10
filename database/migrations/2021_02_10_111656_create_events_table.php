<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('image', 500);
            $table->string('organizer_name', 255);
            $table->integer('category_id');
            $table->integer('user_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('venue', 255)->nullable();
            $table->string('city_id', 255);
            $table->string('state_id', 255);
            $table->string('country_id', 255);
            $table->string('timezone', 255);
            $table->text('description')->nullable();
            $table->string('event_priority', 255)->nullable();
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
        Schema::dropIfExists('events');
    }
}
