<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('document_id')->nullable();
            $table->string('reason');
            $table->date('date_');
            $table->time('start');
            $table->time('end');
            $table->bigInteger('request_by')->unsigned();//emp_id
            $table->bigInteger('approved_by')->unsigned()->nullable();//emp_id
            $table->enum('status', ['approved','rejected','pending'])->default('pending');
            $table->enum('category', ['full day','half day','short leave'])->default('full day');
            $table->enum('type', ['no pay','sick','annual'])->default('no pay');
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
        Schema::dropIfExists('leave_requests');
    }
}
