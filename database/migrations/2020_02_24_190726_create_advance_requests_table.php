<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_requests', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('request_by')->unsigned();//emp_id
            $table->bigInteger('approved_by')->unsigned();//emp_id
            $table->decimal('amount',10,2);
            $table->String('notes')->nullable();
            $table->enum('status', ['approved','rejected','pending'])->default('pending');
            $table->year('for_year');
            $table->enum('for_month', ['January','February','March','April','May','June','July','August','September','October','November','December'])->default('January');
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
        Schema::dropIfExists('advance_requests');
    }
}
