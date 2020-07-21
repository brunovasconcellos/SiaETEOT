<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('employee_id');
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("sector_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("user_id")->references("user_id")->on("users");
            $table->foreign("sector_id")->references("sector_id")->on("sectors");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
