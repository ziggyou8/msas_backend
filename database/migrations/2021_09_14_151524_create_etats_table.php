<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtatsTable extends Migration {

	public function up()
	{
		Schema::create("etats", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned();
			$table->string("type_achat")->nullable();
			$table->string("domaine_intervention_sante")->nullable();
			$table->string("piliers_intervention")->nullable();
			$table->string("beneficiaire")->nullable();
			$table->string("mt_mobilise_par_annee")->nullable();
			$table->string("realisation")->nullable();
			$table->string("prestation_prise_en_charge")->nullable();
			$table->string("projet_en_cours")->nullable();
			$table->string("opportunites")->nullable();
			$table->string("perspective")->nullable();
			$table->string("documents")->nullable();
			$table->string("service_soins_achetes")->nullable();
			$table->string("mecanisme_achat")->nullable();
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop("etats");
	}
}