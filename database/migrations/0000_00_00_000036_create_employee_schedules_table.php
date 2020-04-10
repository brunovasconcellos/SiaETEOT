<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_schedules', function (Blueprint $table) {
            $table->bigIncrements('sched_empl_id');
            $table->timestamp("start_hour")->nullable();
            $table->timestamp("end_hour")->nullable();
            $table->string("week_day");
            $table->bigInteger("employee_id")->unsigned();
            $table->timestamps();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_schedules');
    }
}
