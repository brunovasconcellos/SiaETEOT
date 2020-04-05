<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSituationHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('situation_historics', function (Blueprint $table) {
            $table->bigIncrements('situat_hist_id');
            $table->string("situation");
            $table->date("dt_situation");
            $table->bigInteger("student_id")->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('situation_historics');
    }
}
