<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->bigIncrements('student_registration');
            $table->string("certification_type");
            $table->string("certification_term");
            $table->string("certification_circ");
            $table->string("certification_book");
            $table->string("certification_sheet");
            $table->string("certification_city");
            $table->string("certification_fu");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_documents');
    }
}
