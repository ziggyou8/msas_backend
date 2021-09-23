<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourceFinancementsTable extends Migration {

	public function up()
	{
		Schema::create("source_financements", function(Blueprint $table) {
			$table->increments("id");
			$table->string("libelle");
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("source_financements");
	}
}