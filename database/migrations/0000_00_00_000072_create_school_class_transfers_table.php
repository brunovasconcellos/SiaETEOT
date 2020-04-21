<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolClassTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_class_transfers', function (Blueprint $table) {
            $table->bigIncrements('school_class_transfer_id');
            $table->integer("process_number");
            $table->bigInteger("student_registration")->unsigned();
            $table->bigInteger("target_class")->unsigned();
            $table->bigInteger("origin_class")->unsigned();
            $table->timestamps();
            $table->foreign("target_class")->references("school_class_id")->on("school_classes");
            $table->foreign("origin_class")->references("school_class_id")->on("school_classes");
            $table->foreign("student_registration")->references("student_registration")->on("students");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_class_transfers');
    }
}
