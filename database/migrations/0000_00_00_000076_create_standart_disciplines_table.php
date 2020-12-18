<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandartDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standart_disciplines', function (Blueprint $table) {
            $table->bigIncrements("standart_id");
            $table->bigInteger("discipline_id")->unsigned();
            $table->bigInteger("school_class_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("discipline_id")->references("discipline_id")->on("disciplines");
            $table->foreign("school_class_id")->references("school_class_id")->on("school_classes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standart_disciplines');
    }
}
