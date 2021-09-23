<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserStructuresTable extends Migration {

	public function up()
	{
		Schema::create("user_structures", function(Blueprint $table) {
			$table->increments("id");
			$table->integer("structure_id")->unsigned()->nullable();
			$table->integer("user_id")->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop("user_structures");
	}
}