<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorCompanyInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_company_informations', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 255);
            $table->text('address');
            $table->integer('city_id')->length(11);
            $table->integer('state_id')->length(11);
            $table->integer('country_id')->length(11);
            $table->string('phone', 255);
            $table->string('email', 255);
            $table->string('website', 255);
            $table->text('company_description');
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
        Schema::dropIfExists('vendor_company_informations');
    }
}
