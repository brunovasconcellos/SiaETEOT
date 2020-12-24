<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculateds', function (Blueprint $table) {
            $table->bigIncrements('matriculated_id');
            $table->timestamp("matriculation_date");
            $table->string('matriculation_type');
            $table->string("school_year");
            $table->string("situation");
            $table->integer("call_number");
            $table->bigInteger("student_registration")->unsigned();
            $table->bigInteger("school_class_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("student_registration")->references("student_registration")->on("students");
            $table->foreign("school_class_id")->references("school_class_id")->on("school_classes");
            $table->foreign("discipline_id")->references("discipline_id")->on("disciplines");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculateds');
    }
}
