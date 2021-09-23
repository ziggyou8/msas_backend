<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sps', function (Blueprint $table) {
            $table->increments("id");
			$table->integer("structure_id")->unsigned();
			$table->string("piliers_intervention")->nullable();
			$table->string("type_structure")->nullable();
			$table->string("numero_autorisation")->nullable();
			$table->string("mt_prevu_par_pilier")->nullable();
			$table->string("mt_mobilise_par_pilier")->nullable();
			$table->string("mt_execute_par_pilier")->nullable();
			$table->string("investissement_en_cours")->nullable();
			$table->string("projets")->nullable();
			$table->string("opportunites")->nullable();
			$table->string("perspective")->nullable();
			$table->string("mecanisme_financement")->nullable();
			$table->string("documents")->nullable();
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sps');
    }
}
