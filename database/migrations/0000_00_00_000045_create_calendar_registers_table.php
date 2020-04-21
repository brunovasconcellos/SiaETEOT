<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_registers', function (Blueprint $table) {
            $table->bigIncrements('calendar_regist_id');
            $table->timestamp("event_start_date")->nullable();
            $table->timestamp("event_end_date")->nullable();
            $table->timestamp("event_register_date")->nullable();
            $table->bigInteger("calendar_id")->unsigned();
            $table->bigInteger("event_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->timestamps();
            $table->foreign("calendar_id")->references("calendar_id")->on("calendars");
            $table->foreign("event_id")->references("event_id")->on("events");
            $table->foreign("user_id")->references("user_id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_registers');
    }
}
