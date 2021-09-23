<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngTable extends Migration {

	public function up()
	{
		Schema::create("ongs", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned();
			$table->string("type")->nullable();
			$table->string("numero_agrement")->nullable();
			$table->string("bailleur")->nullable();
			$table->string("sous_recipiandaire")->nullable();
			$table->string("date_debut_intervention")->nullable();
			$table->string("date_fin_intervention")->nullable();
			$table->string("email")->nullable();
			$table->string("piliers_intervention")->nullable();
			$table->string("montant_global_projet")->nullable();
			$table->string("mt_prevu_par_pilier")->nullable();
			$table->string("mt_mobilise_par_pilier")->nullable();
			$table->string("mt_execute_par_pilier")->nullable();
			$table->string("mecanisme_financement")->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("ongs");
	}
}