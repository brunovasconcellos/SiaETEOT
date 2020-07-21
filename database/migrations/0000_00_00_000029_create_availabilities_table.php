<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->bigIncrements('availability_id');
            $table->string("school_year");
            $table->string("week_day");
            $table->timestamp("start_hour")->nullable();
            $table->timestamp("finish_hour")->nullable();
            $table->bigInteger("employee_id")->unsigned();
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
        Schema::dropIfExists('availabilities');
    }
}
