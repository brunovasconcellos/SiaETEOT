<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('content_id');
            $table->string("content_name");
            $table->string("description");
            $table->timestamp("content_date")->nullable();
            $table->timestamp("content_schedule")->nullable();
            $table->bigInteger("schedule_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('contents');
    }
}
