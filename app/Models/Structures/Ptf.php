<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptf extends Model
{
    use HasFactory;
    protected $table = "ptfs";
    public $timestamps = true;
    protected $fillable = array("structure_id","type", "pays_nationalite", "numero_agrement","agent_execution","date_debut_intervention","date_fin_intervention","piliers_intervention","mt_prevu_par_pilier_annee_en_cour","mt_mobilise_par_pilier","mt_execute_par_pilier","mecanisme_financement","bailleur","projection_annee_n_plus1_par_pilier","projection_annee_n_plus2_par_pilier");

    public function structure()
    {
        return $this->belongsTo(Structure::class, "structure_id", "id");
    }
}
