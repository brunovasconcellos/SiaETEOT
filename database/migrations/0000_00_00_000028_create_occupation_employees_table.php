<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupationEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupation_employees', function (Blueprint $table) {
            $table->bigIncrements('occup_emp_id');
            $table->timestamp("start_date")->nullable();
            $table->timestamp("final_date")->nullable();
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("occupation_id")->unsigned();
            $table->timestamps();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
            $table->foreign("occupation_id")->references("occupation_id")->on("occupations");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('occupation_employees');
    }
}
