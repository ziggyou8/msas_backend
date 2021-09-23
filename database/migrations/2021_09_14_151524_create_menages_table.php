<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenagesTable extends Migration {

	public function up()
	{
		Schema::create("menages", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("menages");
	}
}