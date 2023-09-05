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
        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->string('card_type')->nullable();
            $table->string('card_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('cvv')->nullable();
            $table->string('name_on_card')->nullable();
            $table->boolean('is_default')->default(0)->comment('0-No, 1-Yes');
            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
           
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
};
