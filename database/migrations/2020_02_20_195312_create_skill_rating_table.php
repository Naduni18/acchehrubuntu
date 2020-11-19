<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_rating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('emp_id')->unsigned();
            $table->bigInteger('rated_by')->unsigned();
            $table->integer('file_receivings')->nullable();
            $table->integer('offers')->nullable();
            $table->integer('visa_grants')->nullable();
            $table->integer('IELTS_class_registrations')->nullable();
            $table->integer('IELTS_exam_registrations')->nullable();
            $table->integer('total_kpi')->nullable();
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('users');
            $table->foreign('rated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_rating');
    }
}
