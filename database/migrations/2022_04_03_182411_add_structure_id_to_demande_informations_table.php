<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStructureIdToDemandeInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande_informations', function (Blueprint $table) {
            $table->integer('structure_id')->unsigned()->nullable()->after('besoin');
            $table->string('code_etat', 50)->default('non_traitee')->nullable()->after('structure_id');
            $table->integer('traitee_par')->unsigned()->nullable()->after('code_etat');
            $table->dateTime('date_traitement')->nullable()->after('traitee_par');

            $table->foreign('structure_id')->references('id')->on('structures')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande_informations', function (Blueprint $table) {
            $table->dropForeign('demande_informations_structure_id_foreign');
        });
    }
}
