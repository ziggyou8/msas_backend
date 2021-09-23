<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Acteur",
 *     description="Acteur model",
 *     @OA\Xml(
 *         name="Acteur"
 *     )
 * )
 */
class TypeActeur extends Model
{
    use HasFactory;

    protected $fillable = ["libelle", "source_financement_id"];

    public function sourceFiancement()
    {
        return $this->belongsTo(SourceFinancement::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class, "type_acteur_id");
    }
}

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),

    * @OA\Property(
    *      property="libelle",
    *      type="string",
    * ),

    * @OA\Property(
    *      property="source_financement_id", 
    *      type="integer",  
    *  ),
    */
