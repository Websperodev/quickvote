<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingContestantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('voting_contestants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contestant_id');
            $table->foreign('contestant_id')->references('id')->on('contestants');
            $table->unsignedBigInteger('voting_id');
            $table->foreign('voting_id')->references('id')->on('voting_contests');
            $table->string('name');
            $table->string('email');
            $table->integer('phone');
            $table->integer('votes')->nullable();
            $table->string('coupon')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('eachamount', $precision = 8, $scale = 2);
            $table->decimal('totalamount', $precision = 8, $scale = 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('voting_contestants');
    }

}
