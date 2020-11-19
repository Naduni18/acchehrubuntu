<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCalenderEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()// company events/tasks
    {
        Schema::create('calender_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('title');
            $table->string('description')->nullable();
            $table->datetime('start')->nullable();
            $table->datetime('end')->nullable();
            $table->time('startTime')->nullable();
            $table->time('endTime')->nullable();
            $table->date('startRecur')->nullable();
            $table->date('endRecur')->nullable();
            $table->uuid('groupId')->nullable();
            $table->string('daysOfWeek')->nullable();
            $table->bigInteger('assigned_by')->unsigned();//empId
            $table->string('assigned_to')->nullable();//empIds separated by comma 
            $table->string('location')->nullable();
            $table->string('notes')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('calender_events');
    }
}
