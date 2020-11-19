<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_schedule', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->datetime('start');
            $table->datetime('end');
            $table->bigInteger('assigned_by')->unsigned();//empId
            $table->bigInteger('conducted_by')->nullable()->unsigned();//empId
            $table->string('assigned_to')->nullable();
            $table->string('location')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
            $table->foreign('conducted_by')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_schedule');
    }
}
