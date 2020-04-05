<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_students', function (Blueprint $table) {
            $table->bigIncrements('paren_stud_id');
            $table->string("kinship");
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("student_id")->unsigned();
            $table->timestamps();
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->foreign("student_id")->references("student_id")->on("students");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_students');
    }
}
