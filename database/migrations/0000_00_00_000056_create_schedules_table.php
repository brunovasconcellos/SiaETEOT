<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('schedule_id');
            $table->string("week_day");
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->integer("amount_time");
            $table->bigInteger("school_class_id")->unsigned();
            $table->bigInteger("able_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("school_class_id")->references("school_class_id")->on("school_classes");
            $table->foreign("able_id")->references("able_id")->on("ables");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
