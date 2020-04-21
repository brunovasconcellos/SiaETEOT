<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_reservations', function (Blueprint $table) {
            $table->bigIncrements('class_reservation_id');
            $table->bigInteger("schedule_id")->unsigned();
            $table->bigInteger("classroom_id")->unsigned();
            $table->timestamps();
            $table->foreign("schedule_id")->references("schedule_id")->on("schedules");
            $table->foreign("classroom_id")->references("classroom_id")->on("classrooms");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_reservations');
    }
}
