<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLesonStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leson_statuses', function (Blueprint $table) {
            $table->bigIncrements('leson_status_id');
            $table->string("status");
            $table->timestamp("leson_date")->nullable();
            $table->bigInteger("schedule_id")->unsigned();
            $table->timestamps();
            $table->foreign("schedule_id")->references("schedule_id")->on("schedules");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leson_statuses');
    }
}
