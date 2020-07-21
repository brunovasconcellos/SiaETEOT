<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentOcurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_ocurrences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("student_registration")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
            $table->foreign("student_registration")->references("student_registration")->on("students");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_ocurrences');
    }
}
