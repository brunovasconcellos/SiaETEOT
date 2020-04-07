<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentComplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_complements', function (Blueprint $table) {
            $table->bigIncrements('student_registration')->unsigned();
            $table->string("ingress_type");
            $table->string("ingress_form");
            $table->string("vagacy_type");
            $table->string("last_school");
            $table->string("ident_educacenso");
            $table->year("year_last_grade");
            $table->timestamps();
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
        Schema::dropIfExists('student_complements');
    }
}
