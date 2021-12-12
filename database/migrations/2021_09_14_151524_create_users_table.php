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
        Schema::create("users", function (Blueprint $table) {
            //$table->id();
            $table->increments("id");
            $table->longText("photo")->nullable();
            $table->string("prenom");
            $table->string("nom");
            $table->string("fonction")->nullable();
            $table->string("email")->unique();
            $table->string("telephone")->nullable();
            $table->integer("structure_id")->unsigned()->nullable();
            /* $table->unsignedInteger("structure_id")->nullable();
            $table->foreign("structure_id")->references("id")->on("structures")->onDelete("cascade"); */
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("users");
    }
}
