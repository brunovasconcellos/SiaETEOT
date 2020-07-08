<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsibleStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsible_students', function (Blueprint $table) {
            $table->bigIncrements('responsible_stud_id');
            $table->string("kinship");
            $table->bigInteger("responsible_id")->unsigned();
            $table->bigInteger("student_registration")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("responsible_id")->references("responsible_id")->on("responsibles");
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
        Schema::dropIfExists('responsible_students');
    }
}
