<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			//new fields 30/04/22
			$table->longText("accord_siege")->nullabble();
			$table->string("date_debut_intervention")->nullabble();
			$table->string("date_fin_intervention")->nullabble();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("structures");
	}
}