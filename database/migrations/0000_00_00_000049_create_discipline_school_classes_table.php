<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplineSchoolClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_school_classes', function (Blueprint $table) {
            $table->bigIncrements('discipline_schoolClass_id');
            $table->bigInteger("school_class_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('discipline_school_classes');
    }
}
