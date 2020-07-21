<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOcurrenceStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocurrence_students', function (Blueprint $table) {
            $table->bigIncrements('employee_id')->unsigned();
            $table->string("providence");
            $table->string("report");
            $table->string("details");
            $table->string("type");
            $table->timestamp("fact_date");
            $table->string("fact");
            $table->bigInteger("ocurrence_id");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocurrence_students');
    }
}
