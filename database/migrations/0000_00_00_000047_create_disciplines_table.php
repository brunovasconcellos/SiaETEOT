<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->bigIncrements('discipline_id');
            $table->string("discipline_name");
            $table->string("discipline_abbreviation");
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
        Schema::dropIfExists('disciplines');
    }
}
