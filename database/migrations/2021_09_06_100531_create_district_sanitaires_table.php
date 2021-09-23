<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictSanitairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("district_sanitaires", function (Blueprint $table) {
            $table->increments("id");
            $table->string("nom");
            $table->unsignedInteger("collectivite_id");
            $table->foreign("collectivite_id")
                ->references("id")
                ->on("collectivites")->onDelete("cascade")->nullable();
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
        Schema::dropIfExists("district_sanitaires");
    }
}
