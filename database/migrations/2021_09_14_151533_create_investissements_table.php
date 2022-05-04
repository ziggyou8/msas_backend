<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investissements', function (Blueprint $table) {
            $table->increments("id");
            $table->string("annee");
            $table->string("monnaie");
			$table->string("statut")->nullable();
			$table->integer("structure_id")->unsigned()->nullable();
            //new fields added 30/04/22
			$table->string("agent_execution")->nullable();
			$table->string("bailleur")->nullable();
			$table->string("montant_global")->nullable();
            
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
        Schema::dropIfExists('investissements');
    }
}
