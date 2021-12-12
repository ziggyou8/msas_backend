<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxeInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axe_interventions', function (Blueprint $table) {
            $table->increments("id");
            $table->string("libelle");
            /* $table->string("montant_prevu");
            $table->string("montant_mobilise");
            $table->string("montant_execute"); */
			$table->integer("pilier_id")->unsigned()->nullable();
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
        Schema::dropIfExists('axe_interventions');
    }
}
