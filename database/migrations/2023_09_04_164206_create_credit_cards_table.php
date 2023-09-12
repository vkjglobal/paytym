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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->BigInteger('primary_card_number');
            $table->string('primary_name_on_card');
            $table->string('primary_expiry_date');
            $table->boolean('primary_is_default')->default(1)->comment('0-No, 1-Yes');

            $table->BigInteger('secondary_card_number')->nullable();
            $table->string('secondary_name_on_card')->nullable();;
            $table->string('secondary_expiry_date')->nullable();
            $table->boolean('secondary_is_default')->default(0)->comment('0-No, 1-Yes');

            $table->string('primary_card_type')->nullable();
            $table->string('secondary_card_type')->nullable();

            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_cards');
    }
};
