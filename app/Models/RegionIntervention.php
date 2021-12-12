<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionIntervention extends Model
{
    use HasFactory;
    protected $table = "region_interventions";
    public $timestamps = false;
    protected $fillable = [
        "nom",
        "structure_id"
    ];

    public function districtsInterventions()
    {
        return $this->hasMany(DistrictIntervention::class);
    }

}
