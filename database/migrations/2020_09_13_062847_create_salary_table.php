<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('emp_id')->unsigned();
            $table->string('name',500)->nullable();
            $table->string('designation',250)->nullable();
            $table->string('branch')->nullable();
            $table->string('department')->nullable();
            $table->year('for_year')->nullable();
            $table->enum('for_month', ['January','February','March','April','May','June','July','August','September','October','November','December'])->nullable();
            $table->date('date')->nullable();
            $table->decimal('basic_salary',10,2)->nullable();
            $table->decimal('variable_allowance',10,2)->nullable();
            $table->decimal('incentice',10,2)->nullable();
            $table->decimal('holiday_allowance',10,2)->nullable();
            $table->decimal('commission',10,2)->nullable();
            $table->decimal('phone_allowance',10,2)->nullable();
            $table->decimal('gross_salary',10,2)->nullable();
            $table->decimal('epf_employe_cont',10,2)->nullable();
            $table->decimal('salary_advance',10,2)->nullable();
            $table->decimal('telephone_deduction',10,2)->nullable();
            $table->decimal('no_pay',10,2)->nullable();
            $table->decimal('staff_loan',10,2)->nullable();
            $table->decimal('paye_tax',10,2)->nullable();
            $table->decimal('total_deductions',10,2)->nullable();
            $table->decimal('net_salary',10,2)->nullable();
            $table->decimal('epf_company_cont',10,2)->nullable();
            $table->decimal('etf_company_cont',10,2)->nullable();
            $table->decimal('remitted_amount',10,2)->nullable();
            $table->string('remitted_account_no')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('EPF_number')->nullable();
            $table->foreign('emp_id')->references('id')->on('users');
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
        Schema::dropIfExists('salary');
    }
}
