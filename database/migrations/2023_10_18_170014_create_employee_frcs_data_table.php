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
        Schema::create('employee_frcs_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('tin')->nullable();
            $table->date('date_of_birth')->nullabe();
            $table->string('tax_code')->nullable();
            $table->string('residence')->nullable();
            $table->date('employment_start_date')->nullable();
            $table->date('employment_end_date')->nullable();
            
            $table->string('yeartodate_normal_pay')->nullable();
            $table->string('yeartodate_dir_rem_and_bonus_overtime')->nullable();
            $table->string('yeartodate_redundancy_payments')->nullable();
            $table->string('yeartodate_lumpsum_payments')->nullable();
            $table->string('yeartodate_other_one_off_payments')->nullable();
            $table->string('yeartodate_income_tax')->nullable();
            $table->string('yeartodate_SRT')->nullable();
            $table->string('yeartodate_ECAL')->nullable();

            $table->string('normal_pay')->nullable();
            $table->string('director_remuneration')->nullable();
            $table->string('bonus_overtime')->nullable();
            $table->string('redundancy_payment_approval_no')->nullable();
            $table->string('redundancy_payments')->nullable();
            $table->string('lumpsum_payment_approval_no')->nullable();
            $table->string('lumpsum_payment')->nullable();
            $table->string('other_oneoff_payment_approval_no')->nullable();
            $table->string('other_oneoff_payment')->nullable();
            $table->string('fnpf_deduction')->nullable();
            $table->string('gross_up_employee')->nullable();
            $table->string('income_tax')->nullable();
            $table->string('SRT')->nullable();
            $table->string('ECAL')->nullable();

            $table->timestamps();
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
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
        Schema::dropIfExists('employee_frcs_data');
    }
};
