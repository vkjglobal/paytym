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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('branch');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->date('date_of_birth');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country');
            $table->string('tin')->nullable();
            $table->string('fnpf')->nullable();
            $table->string('bank');
            $table->string('account_number');
            $table->string('image')->nullable();
            $table->string('isFirst')->default(0)->comment('0-No, 1-Yes');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
