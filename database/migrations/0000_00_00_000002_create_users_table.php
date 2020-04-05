<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name');
            $table->string("last_name");
            $table->date("date_of_bith");
            $table->char("gender", 1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("user_name");
            $table->string('password');
            $table->integer("cell_phone");
            $table->boolean("active");
            $table->integer("rg");
            $table->integer("cpf");
            $table->bigInteger("cep_user")->unsigned();
            $table->bigInteger("contact_id")->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign("cep_user")->references("cep")->on("localities");
            $table->foreign("contact_id")->references("contact_id")->on("contacts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
