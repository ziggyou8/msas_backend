<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureInvestissement extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = array("libelle", "montant_prevu","montant_mobilise", "montant_execute", "axe_intervention_id");

}
