<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeActeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_acteurs', function (Blueprint $table) {
            $table->id(); 
            $table->string('libelle');
            $table->unsignedInteger('source_financement_id');
            $table->foreign('source_financement_id')->references('id')->on('source_financements')->onDelete('cascade');
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
        Schema::dropIfExists('type_acteurs');
    }
}
