<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictIntervention extends Model
{
    use HasFactory;
    protected $table = "district_interventions";
    public $timestamps = false;
    protected $fillable = [
        "nom",
        "region_intervention_id"
    ];
}
