<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Collectivite",
 *     description="Collectivite model",
 *     @OA\Xml(
 *         name="Collectivite"
 *     )
 * )
 */
class Collectivite extends Model
{
    use HasFactory;


    protected $table = "collectivites";
    public $timestamps = false;

    protected $fillable = array("code", "nom", "statut", "type_collectivite", "parent_code");

    public function parent()
    {
        return $this->belongsTo(Collectivite::class, "parent_code", "code");
    }

    public function districtes()
    {
        return $this->hasMany(DistrictSanitaire::class);
    }

    public function scopeByCodeParent($query, $code)
    {
        if ($code)
            return $query->where("parent_code", "like", $code . "%");
        return $query;
    }

    public function scopeByType($query, $type)
    {
        if ($type)
            return $query->where("type_collectivite", $type);
        return $query;
    }

    public function scopeByCode($query, $code)
    {
        if ($code)
            return $query->where("code", "like", $code . "%");
        return $query;
    }

    public function scopeForCollectivite($query, $code)
    {
        return $query->where("code", $code);
    }

    /**
     * Permet de récuperer le département d"un quartier village
     * @return mixed
     */
    public function getDepartementQvAttribute()
    {
        return $this->parent->parent->parent;
    }

    /**
     * Permet de récuperer la région d"un quartier village
     * @return mixed
     */
    public function getRegionQvAttribute()
    {
        return $this->departement_qv->parent;
    }

    /**
     * Permet de récuperer le département d"une commune
     * @return mixed
     */
    public function getDepartementCommuneAttribute()
    {
        return $this->parent->parent;
    }

    /**
     * Permet de récuperer la région d"une commune
     * @return mixed
     */
    public function getRegionCommuneAttribute()
    {
        return $this->departement_commune->parent;
    }

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),

    * @OA\Property(
    *      property="nom",
    *      type="string",
    * ),
    * 
    * @OA\Property(
    *      property="code",
    *      type="string",
    * ),
    *
    * @OA\Property(
    *      property="statut",
    *      type="string",
    * ),
    *
    * @OA\Property(
    *      property="type_collectivite",
    *      type="string",
    * ),
    * 
    * @OA\Property(
    *      property="parent_code",
    *      type="string",
    * ),
    */
}
