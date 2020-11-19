<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cv_id');
            $table->string('name',100);
            $table->string('NIC',12)->unique();
            $table->string('email',100)->unique();
            $table->string('applied_job_position',250)->nullable();
            $table->datetime('first_interview_date')->nullable();
            $table->datetime('second_interview_date')->nullable();
            $table->bigInteger('interviewer')->unsigned()->nullable();
            $table->string('notes',250)->nullable();
            $table->enum('current_status', ['cv_selected','keeping_cv_for_future_vacancies', 'first_interview_passed','second_interview_passed'])->default('cv_selected');
            $table->timestamps();
            $table->foreign('interviewer')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment');
    }
}
