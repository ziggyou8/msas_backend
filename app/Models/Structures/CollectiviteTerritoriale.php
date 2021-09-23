<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class CollectiviteTerritoriale extends Model 
{

    protected $table = "collertvite_territoriale";
    public $timestamps = true;
    protected $fillable = array("structure_id", "nbr_structure_sante_polarises", "type_structure_sante_polarises", "domaine_intervention_sante", "volume_investissement_global_sante", "volume_investissement_sante", "montant_fdd_mobilise_sante", "montant_fonds_propre_sante", "montant_fecl_mobilise_sante", "accord_de_siege");

}