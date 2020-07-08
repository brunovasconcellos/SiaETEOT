<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exerts', function (Blueprint $table) {
            $table->bigIncrements('exerts_id');
            $table->string("registration");
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("position_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("employee_id")->references("employee_id")->on("employees");
            $table->foreign("position_id")->references("position_id")->on("positions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exerts');
    }
}
