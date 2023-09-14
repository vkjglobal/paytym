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
        Schema::create('project_daily_expense', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('date');
            $table->integer('worked_hours');
            $table->decimal('expense_amount');
            $table->boolean('employee_status')->default(1)->comment('0-InActive, 1-Active');;
            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_daily_expense');
    }
};
