<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Model;
use App\Models\sousRecipiandaire;

class Ong extends Model 
{

    protected $table = "ongs";
    public $timestamps = true;
    protected $fillable = array("structure_id", "type", "numero_agrement", "bailleur", "date_fin_intervention", "date_debut_intervention", "email", "piliers_intervention", "montant_global_projet", "mt_prevu_par_pilier", "mt_mobilise_par_pilier", "mt_execute_par_pilier", "mecanisme_financement");

    public function sous_recipiandaires()
    {
        return $this->hasMany(sousRecipiandaire::class);
    }

}