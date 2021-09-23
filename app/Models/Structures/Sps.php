<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sps extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = array("structure_id","piliers_intervention", "type_structure","numero_autorisation", "mt_prevu_par_pilier", "mt_mobilise_par_pilier", "mt_execute_par_pilier", "investissement_en_cours", "projets", "opportunites", "perspective", "documents", "mecanisme_financement");
}
