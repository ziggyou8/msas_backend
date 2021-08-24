<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Structure",
 *     description="Structure model",
 *     @OA\Xml(
 *         name="Structure"
 *     )
 * )
 */

class Structure extends Model
{
    use HasFactory;
    protected $fillable = [
        'denomination',
        'type_fonds', 
        'addresse_siege',
        'telephone',
        'prenom_personne_responsable',
        'nom_personne_responsable',
        'telephone_personne_responsable',
        'email_personne_responsable',
        'source_financement_id'
    ];

    public function sourceFiancement()
    {
        return $this->belongsTo(SourceFinancement::class, 'source_financement_id')->select('id', 'denomination');
    }

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),
    *
    * @OA\Property(
    *      property="denomination",
    *      type="string",
    * ),

    * @OA\Property(
    *      property="type_fonds", 
    *      type="string",  
    *  ),

     * @OA\Property(
     *      property="addresse_siege",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="telephone",
     *      type="string", 
     * ),
     * 
     * 
     * @OA\Property(
     *      property="source_financement_id",
     *      type="integer", 
     * ),
     * 
     * @OA\Property(
     *      property="prenom_personne_responsable",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="nom_personne_responsable",
     *      type="string", 
     * ),
     * @OA\Property(
     *      property="email_personne_responsable",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="telephone_personne_responsable",
     *      type="string", 
     * ),
     * 
     * 
     */
}
