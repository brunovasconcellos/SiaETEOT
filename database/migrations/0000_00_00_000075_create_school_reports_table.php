<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_reports', function (Blueprint $table) {
            $table->id("matriculated_id");
            $table->float("grade_first_trimester");
            $table->float("grade_first_recuperation");
            $table->integer("first_predicted_lesson");
            $table->integer("first_performed_lesson");
            $table->float("grade_second_trimester");
            $table->float("grade_second_recuperation");
            $table->integer("second_predicted_lesson");
            $table->integer("second_performed_lesson");
            $table->float("grade_third_trimester");
            $table->float("grade_third_recuperation");
            $table->integer("third_predicted_lesson");
            $table->integer("third_performed_lesson");
            $table->string("situation_before_final_recup");
            $table->float("grade_final_recuperation");
            $table->string("situation_after_final_recup");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("matriculated_id")->references("matriculated_id")->on("matriculateds");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_reports');
    }
}
