<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_disciplines', function (Blueprint $table) {
            $table->bigIncrements("course_discipline_id");
            $table->bigInteger("course_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();;
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("course_id")->references("course_id")->on("courses");
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
        Schema::dropIfExists('course_disciplines');
    }
}
