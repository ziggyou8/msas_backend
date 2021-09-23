<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMecanismeFinancementsTable extends Migration {

	public function up()
	{
		Schema::create("mecanisme_financements", function(Blueprint $table) {
			$table->increments("id");
			$table->string("libelle");
			$table->integer("type_acteur_id")->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("mecanisme_financements");
	}
}