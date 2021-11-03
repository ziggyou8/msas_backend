<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AxeIntervention extends Model
{
    use HasFactory;
    protected $table = "axe_interventions";
    public $timestamps = true;
    protected $fillable = array("pilier_id", "libelle", "montant_prevu", "montant_mobilise", "montant_execute");
}
