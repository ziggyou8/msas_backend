<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSecteurPriveNonSanitairesTable extends Migration {

	public function up()
	{
		Schema::create("secteur_prive_non_sanitaires", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->timestamps();
			$table->string("numero_agrement")->nullable();
			$table->string("adresse_siege")->nullable();
			$table->string("type_entreprise")->nullable();
			$table->string("domaine_intervention")->nullable();
			$table->string("secteur_intervention_sante")->nullable();
			$table->string("rse_intervention_sante")->nullable();
			$table->string("volume_investissement_global")->nullable();
			$table->string("volume_investissement_par_annee")->nullable();
			$table->string("date_debut_intervention")->nullable();
			$table->string("date_fin_intervention")->nullable();
			$table->string("partenaire_de_mis_en_ouvre")->nullable();
		});
	}

	public function down()
	{
		Schema::drop("secteur_prive_non_sanitaires");
	}
}