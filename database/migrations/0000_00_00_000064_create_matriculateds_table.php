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
            $table->bigIncrements("matriculated_id");
            $table->timestamp("matriculation_date");
            $table->integer("call_number");
            $table->timestamp("year_school_class");
            $table->bigInteger("student_registration")->unsigned();
            $table->bigInteger("school_class_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
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
