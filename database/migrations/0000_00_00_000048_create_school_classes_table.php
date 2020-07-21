<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->bigIncrements('school_class_id');
            $table->string("school_class_name");
            $table->string("school_class_type");
            $table->year("school_year");
            $table->string("situation");
            $table->string("shift");
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->string("modality");
            $table->bigInteger("course_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("course_id")->references("course_id")->on("courses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_classes');
    }
}
