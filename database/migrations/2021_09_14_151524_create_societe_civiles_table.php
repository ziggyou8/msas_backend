<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocieteCivilesTable extends Migration {

	public function up()
	{
		Schema::create("societe_civiles", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("societe_civiles");
	}
}