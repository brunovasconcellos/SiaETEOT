<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string("last_name")->after("name");
            $table->timestamp("date_of_birth")->after("password")->nullable();
            $table->char("gender", 1)->after("date_of_birth");
            $table->string("user_name")->after("gender");
            $table->bigInteger("cell_phone")->after("user_name");
            $table->boolean("active")->nullable()->after("cell_phone");
            $table->bigInteger("identity_rg")->after("active");
            $table->date("identity_em_dt")->after("identity_rg");
            $table->string("identity_issuing_authority")->after("identity_em_dt");
            $table->bigInteger("cpf")->after("identity_issuing_authority");
            $table->bigInteger("cep_user")->unsigned()->after("cpf");
            $table->tinyInteger("level")->default(1)->after("cep_user");
            $table->foreign("cep_user")->references("cep")->on("localities");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
