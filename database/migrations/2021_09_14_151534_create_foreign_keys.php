<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
		/* Schema::table("cts", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		}); */
		Schema::table("ongs", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("axe_interventions", function(Blueprint $table) {
			$table->foreign("pilier_id")->references("id")->on("piliers")
						->onDelete("cascade")
						->onUpdate("restrict");
		});

		Schema::table("piliers", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("projets", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});

		Schema::table("investissements", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});


		Schema::table("agent_bailleurs", function(Blueprint $table) {
			$table->foreign("ong_id")->references("id")->on("ongs")
						->onDelete("cascade")
						->onUpdate("restrict");
			$table->foreign("ptf_id")->references("id")->on("ptfs")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("sous_recipiandaires", function(Blueprint $table) {
			$table->foreign("ong_id")->references("id")->on("ongs")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("eps", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("sps", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("etats", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("secteur_prive_sanitaires", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("secteur_prive_sanitaires")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("secteur_prive_non_sanitaires", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("menages", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("user_structures", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("user_structures", function(Blueprint $table) {
			$table->foreign("user_id")->references("id")->on("users")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("societe_civiles", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("mecanisme_financements", function(Blueprint $table) {
			$table->foreign("type_acteur_id")->references("id")->on("type_acteurs")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
		Schema::table("collertvite_territoriale", function(Blueprint $table) {
			$table->foreign("structure_id")->references("id")->on("structures")
						->onDelete("cascade")
						->onUpdate("restrict");
		});
	}

	public function down()
	{
		/* Schema::table("cts", function(Blueprint $table) {
			$table->dropForeign("cts_structure_id_foreign");
		}); */
		Schema::table("ongs", function(Blueprint $table) {
			$table->dropForeign("ongs_structure_id_foreign");
		});
		Schema::table("sous_recipiandaires", function(Blueprint $table) {
			$table->dropForeign("sous_recipiandaires_ong_id_foreign");
		});
		Schema::table("eps", function(Blueprint $table) {
			$table->dropForeign("eps_structure_id_foreign");
		});
		Schema::table("sps", function(Blueprint $table) {
			$table->dropForeign("sps_structure_id_foreign");
		});
		Schema::table("etats", function(Blueprint $table) {
			$table->dropForeign("etats_structure_id_foreign");
		});
		Schema::table("secteur_prive_sanitaires", function(Blueprint $table) {
			$table->dropForeign("secteur_prive_sanitaires_structure_id_foreign");
		});
		Schema::table("secteur_prive_non_sanitaires", function(Blueprint $table) {
			$table->dropForeign("secteur_prive_non_sanitaires_structure_id_foreign");
		});
		Schema::table("menages", function(Blueprint $table) {
			$table->dropForeign("menages_structure_id_foreign");
		});
		Schema::table("user_structures", function(Blueprint $table) {
			$table->dropForeign("user_structures_structure_id_foreign");
		});
		Schema::table("user_structures", function(Blueprint $table) {
			$table->dropForeign("user_structures_user_id_foreign");
		});
		Schema::table("societe_civiles", function(Blueprint $table) {
			$table->dropForeign("societe_civiles_structure_id_foreign");
		});
		Schema::table("mecanisme_financements", function(Blueprint $table) {
			$table->dropForeign("mecanisme_financements_type_acteur_id_foreign");
		});
		Schema::table("collertvite_territoriale", function(Blueprint $table) {
			$table->dropForeign("collertvite_territoriale_structure_id_foreign");
		});
		Schema::table("axe_interventions", function(Blueprint $table) {
			$table->dropForeign("axe_interventions_pilier_id_foreign");
		});

		Schema::table("agent_bailleurs", function(Blueprint $table) {
			$table->dropForeign("agent_bailleurs_ong_id_foreign");
			$table->dropForeign("agent_bailleurs_ptf_id_foreign");
		});

		Schema::table("piliers", function(Blueprint $table) {
			$table->dropForeign("piliers_structure_id_foreign");
		});
		Schema::table("projets", function(Blueprint $table) {
			$table->dropForeign("projets_structure_id_foreign");
		});
		Schema::table("investissements", function(Blueprint $table) {
			$table->dropForeign("investissements_structure_id_foreign");
		});
	}
}