<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eps extends Model
{
    use HasFactory;
    protected $table = "eps";
    public $timestamps = true;
    protected $fillable = array("structure_id","piliers_intervention", "mt_prevu_par_pilier", "mt_mobilise_par_pilier", "mt_execute_par_pilier", "investissement_en_cours", "projets", "opportunites", "perspective", "documents", "mecanisme_financement");
}
