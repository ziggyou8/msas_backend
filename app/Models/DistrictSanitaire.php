<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Districte",
 *     description="Districte model",
 *     @OA\Xml(
 *         name="Districte"
 *     )
 * )
 */
class DistrictSanitaire extends Model
{
    use HasFactory;

    protected $fillable = ["nom", "collectivite_id"];

    public function collectivite()
    {
        return $this->belongsTo(Collectivite::class);
    }

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),
    *
    * @OA\Property(
    *      property="nom",
    *      type="string",
    * ),
    *
    * @OA\Property(
    *      property="collectivite_id",
    *      type="integer",
    * ),
    * 
    */
}
