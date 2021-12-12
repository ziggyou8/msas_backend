<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStructuresTable extends Migration {

	public function up()
	{
		Schema::create("structures", function(Blueprint $table) {
			$table->increments("id");
			$table->string("type_acteur")->nullable();
			$table->string("denomination")->nullable();
			$table->string("telephone_siege")->nullable();
			$table->string("source_financement")->nullable();
			$table->string("adresse_siege")->nullable();
			$table->string("specialite")->nullable();
			$table->string("categorie_rse")->nullable();
			$table->string("autre_specialite")->nullable();
			//$table->string("autre_secteur_intervention")->nullable();
			/* $table->string("secteur_intervention")->nullable();
			$table->string("paquet_sante_intervention")->nullable();
			$table->string("region_intervention")->nullable();
			$table->string("departement_intervention")->nullable();
			$table->string("commune_intervention")->nullable();
			$table->string("districte_intervention")->nullable(); */
			$table->boolean("mobilisation_ressource")->nullable();
			$table->boolean("mis_en_commun_ressource")->nullable();
			$table->boolean("achat_service")->nullable();
			$table->string("email_siege")->nullable();
			$table->string("latitude")->nullable();
			$table->string("longitude")->nullable();
			$table->string("altitude")->nullable();
			$table->string("prenom_responsable")->nullable();
			$table->string("nom_responsable")->nullable();
			$table->string("telephone_responsable")->nullable();
			$table->string("email_responsable")->nullable();
			$table->string("fonction_responsable")->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("structures");
	}
}