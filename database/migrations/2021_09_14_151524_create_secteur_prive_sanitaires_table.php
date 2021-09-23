<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSecteurPriveSanitairesTable extends Migration {

	public function up()
	{
		Schema::create("secteur_prive_sanitaires", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("secteur_prive_sanitaires");
	}
}