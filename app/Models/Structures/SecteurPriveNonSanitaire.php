<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class SecteurPriveNonSanitaire extends Model 
{

    protected $table = "secteur_prive_non_sanitaires";
    public $timestamps = true;
    protected $fillable = array("structure_id", "numero_agrement", "adresse_siege", "type_entreprise", "domaine_intervention", "secteur_intervention_sante", "rse_intervention_sante", "volume_investissement_global", "volume_investissement_par_annee", "date_debut_intervention", "date_fin_intervention", "partenaire_de_mis_en_ouvre");

}