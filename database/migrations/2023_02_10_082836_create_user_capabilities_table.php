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
        Schema::create('user_capabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');                       
            $table->boolean('wages')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('projects')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('attendance')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('approve_attendance')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('medical')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('contract_period')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('deductions')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('create_chat_groups')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('create_meetings')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('approve_leaves')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('view_payroll')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('approve_payroll')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('calculate_payroll')->default(1)->comment('0-No, 1-Yes');
            $table->boolean('edit_deduction')->default(1)->comment('0-No, 1-Yes');
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_capabilities');
        //Schema::table('user_capabilities', function (Blueprint $table) {
            //
       // });
    }
};
