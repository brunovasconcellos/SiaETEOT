<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaches', function (Blueprint $table) {
            $table->bigIncrements('teach_id');
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->bigInteger("discipline_id")->unsigned();
            $table->bigInteger("employee_id")->unsigned();
            $table->timestamps();
            $table->foreign("discipline_id")->references("discipline_id")->on("disciplines");
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
        Schema::dropIfExists('teaches');
    }
}
