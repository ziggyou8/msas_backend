<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;

class Ong extends Model 
{

    protected $table = "ongs";
    public $timestamps = true;
    protected $fillable = array("structure_id", "type", "numero_agrement", "bailleur", "sous_recipiandaire", "date_fin_intervention", "date_debut_intervention", "email", "piliers_intervention", "montant_global_projet", "mt_prevu_par_pilier", "mt_mobilise_par_pilier", "mt_execute_par_pilier", "mecanisme_financement");

}