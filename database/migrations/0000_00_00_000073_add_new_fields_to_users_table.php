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
            $table->bigInteger("cell_phone")->after("gender");
            $table->bigInteger("identity_rg")->after("cell_phone");
            $table->date("identity_em_dt")->after("identity_rg");
            $table->string("identity_issuing_authority")->after("identity_em_dt");
            $table->bigInteger("cpf")->after("identity_issuing_authority");
            $table->bigInteger("cep_user")->unsigned()->after("cpf");
            $table->tinyInteger("level")->default(1)->after("cep_user");
            $table->string("num_residence")->after("level");
            $table->string("complement_residence")->after("num_residence");
            $table->foreign("cep_user")->references("cep")->on("localities");
            $table->softDeletes()->after("updated_at");

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
