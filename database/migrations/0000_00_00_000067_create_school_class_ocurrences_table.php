<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolClassOcurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_class_ocurrences', function (Blueprint $table) {
            $table->bigIncrements('ocurrence_class_id');
            $table->string("fact");
            $table->timestamp("fact_date")->nullable();
            $table->string("providence");
            $table->string("type");
            $table->string("detail");
            $table->string("involvement");
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("school_class_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
            $table->foreign("school_class_id")->references("school_class_id")->on("school_classes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_class_ocurrences');
    }
}
