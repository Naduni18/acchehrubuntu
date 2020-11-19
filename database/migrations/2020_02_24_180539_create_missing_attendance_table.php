<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissingAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missing_attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('reason');
            $table->date('date');
            $table->time('start')->nullable();
            $table->time('startmid')->nullable();
            $table->time('endmid')->nullable();
            $table->time('end')->nullable();
            $table->bigInteger('request_by')->unsigned();//emp_id
            $table->bigInteger('manger_to_approve')->unsigned()->nullable();//emp_id
            $table->enum('status', ['approved','rejected','pending'])->default('pending');
            $table->timestamps();
            $table->foreign('request_by')->references('id')->on('users');
            $table->foreign('manger_to_approve')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missing_attendance');
    }
}
