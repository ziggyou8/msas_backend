<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNatureInvestissementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nature_investissements', function (Blueprint $table) {
            $table->increments("id");
            $table->string("libelle");
            $table->string("montant_prevu");
            $table->string("montant_mobilise");
            $table->string("montant_execute");
            $table->integer("axe_intervention_id")->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nature_investissements');
    }
}
