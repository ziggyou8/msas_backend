<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class Etat extends Model 
{

    protected $table = "etats";
    public $timestamps = true;
    protected $fillable = array("structure_id", "type_achat", "domaine_intervention_sante", "piliers_intervention", "beneficiaire", "piliers_intervention", "beneficiaire", "mt_mobilise_par_annee", "realisation", "prestation_prise_en_charge", "projet_en_cours", "opportunites", "perspective", "documents", "service_soins_achetes", "mecanisme_achat");

}