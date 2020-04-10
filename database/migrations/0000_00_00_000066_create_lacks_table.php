<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lacks', function (Blueprint $table) {
            $table->bigIncrements('lack_id');
            $table->string("lack_type");
            $table->bigInteger("matriculated_id")->unsigned();
            $table->bigInteger("leson_status_id")->unsigned();
            $table->timestamps();
            $table->foreign("matriculated_id")->references("matriculated_id")->on("matriculateds");
            $table->foreign("leson_status_id")->references("leson_status_id")->on("leson_statuses");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lacks');
    }
}
