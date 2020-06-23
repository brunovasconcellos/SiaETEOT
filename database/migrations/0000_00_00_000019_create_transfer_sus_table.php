<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferSusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_sus', function (Blueprint $table) {
            $table->bigIncrements('trans_id');
            $table->integer("process_number");
            $table->timestamp("transfer_date");
            $table->string("transfer_type");
            $table->bigInteger("student_registration")->unsigned();
            $table->bigInteger("su_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("student_registration")->references("student_registration")->on("students");
            $table->foreign("su_id")->references("su_id")->on("student_units");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_sus');
    }
}
