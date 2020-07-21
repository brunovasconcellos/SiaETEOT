<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ables', function (Blueprint $table) {
            $table->bigIncrements('able_id');
            $table->string("school_year");
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("discipline_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('ables');
    }
}
