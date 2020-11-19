<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_claim', function (Blueprint $table) {
            $table->bigIncrements('claim_id');
            $table->date('date');
            $table->String('reason');
            $table->double('amount',10,2);
            $table->String('bill_id');
            $table->bigInteger('request_by')->unsigned();//emp_id
            $table->bigInteger('approved_by')->unsigned();//emp_id
            $table->enum('status', ['approved','rejected','pending'])->default('pending');
            $table->timestamps();
            $table->foreign('request_by')->references('id')->on('users');
            $table->foreign('approved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_claim');
    }
}
