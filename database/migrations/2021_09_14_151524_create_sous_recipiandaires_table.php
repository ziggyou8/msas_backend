<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousRecipiandairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_recipiandaires', function (Blueprint $table) {
            $table->increments("id");
			$table->integer("ong_id")->nullable()->unsigned();
			$table->string("projet")->nullable();
			$table->string("montant")->nullable();
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
        Schema::dropIfExists('sous_recipiandaires');
    }
}
