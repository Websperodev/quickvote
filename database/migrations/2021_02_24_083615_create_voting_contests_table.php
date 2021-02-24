<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotingContestsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('voting_contests', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['1', '2'])->default('1')->comment('1=>Pageants (Not Categorized) ,2=>Awards (Categorized)');
            $table->enum('type', ['paid', 'free'])->default('free');
            $table->enum('packages', ['0', '1'])->default('0')->comment('0=>Disabled,1=>Enabled');
            $table->enum('limit', ['0', '1'])->default('0')->comment('0=>Disabled,1=>Enabled');         
            $table->integer('limit_count')->nullable();
            $table->enum('profile_view', ['0', '1'])->default('0')->comment('0=>OFF,1=>ON');
            $table->enum('payment_gateway', ['paystack', 'flutterwavwe', 'payu', 'interswitch'])->default('paystack');
            $table->enum('payment_crypto', ['0', '1'])->default('0');
            $table->string('title');
            $table->string('image');
            $table->dateTime('starting_date');
            $table->dateTime('closing_date');
            $table->string('timezone', 255);
            $table->integer('added_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('voting_contests');
    }

}
