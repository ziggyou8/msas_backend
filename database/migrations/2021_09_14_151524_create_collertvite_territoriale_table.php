<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollertviteTerritorialeTable extends Migration {

	public function up()
	{
		Schema::create("collertvite_territoriale", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->integer("nbr_structure_sante_polarises")->nullable();
			$table->string("type_structure_sante_polarises")->nullable();
			$table->string("domaine_intervention_sante")->nullable();
			$table->string("volume_investissement_global_sante")->nullable();
			$table->string("volume_investissement_sante")->nullable();
			$table->string("montant_fdd_mobilise_sante")->nullable();
			$table->string("montant_fonds_propre_sante")->nullable();
			$table->string("montant_fecl_mobilise_sante")->nullable();
			$table->string("accord_de_siege")->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("collertvite_territoriale");
	}
}