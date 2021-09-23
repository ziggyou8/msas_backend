<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePtfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("ptfs", function (Blueprint $table) {
            $table->id();
            $table->integer("structure_id")->unsigned();
			$table->string("type")->nullable();
			$table->string("pays_nationalite")->nullable();
			/* $table->string("adresse_siege")->nullable(); */
			$table->string("numero_agrement")->nullable();
			$table->string("agent_execution")->nullable();
			$table->string("date_debut_intervention")->nullable();
			$table->string("date_fin_intervention")->nullable();
			$table->string("piliers_intervention")->nullable();
			$table->string("mt_prevu_par_pilier_annee_en_cour")->nullable();
			$table->string("mt_mobilise_par_pilier")->nullable();
			$table->string("mt_execute_par_pilier")->nullable();
			$table->string("mecanisme_financement")->nullable();
			$table->string("bailleur")->nullable();
			$table->string("projection_annee_n_plus1_par_pilier")->nullable();
			$table->string("projection_annee_n_plus2_par_pilier")->nullable();
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
        Schema::dropIfExists("ptfs");
    }
}
