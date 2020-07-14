<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolReportMatriculatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_report_matriculateds', function (Blueprint $table) {
            $table->id("school_report_matriculated_id");
            $table->bigInteger("school_report_id")->unsigned();
            $table->bigInteger("matriculated_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("school_report_id")->references("school_report_id")->on("school_reports");
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
        Schema::dropIfExists('school_report_matriculateds');
    }
}
