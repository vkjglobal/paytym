<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('user_type')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('company_phone');
            $table->string('phone');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country');
            $table->string('tin')->nullable();
            $table->string('website')->nullable();
            $table->string('registration_certificate')->nullable();
            $table->string('tin_letter')->nullable();
            $table->string('logo')->nullable();
            $table->string('otp')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('status')->default(1)->nullable();
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
        Schema::dropIfExists('employers');
    }
};
