<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypeActeursTable extends Migration {

	public function up()
	{
		Schema::create("type_acteurs", function(Blueprint $table) {
			$table->increments("id");
			$table->string("libelle")->nullable();
			$table->string("source_financement_id");
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("type_acteurs");
	}
}