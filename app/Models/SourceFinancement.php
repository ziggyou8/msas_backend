<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="SourceFinancement",
 *     description="Source Financement model",
 *     @OA\Xml(
 *         name="SourceFinancement"
 *     )
 * )
 */
class SourceFinancement extends Model
{
    use HasFactory;

    protected $fillable = ["denomination"/* , "structure_id" */];

    public function acteurs()
    {
        return $this->hasMany(TypeActeur::class);
    }

    public function structure()
    {
        return $this->hasOne(Structure::class);
    }
     /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),

    * @OA\Property(
    *      property="denomination",
    *      type="string",
    * ),

    * @OA\Property(
    *      property="type_acteur[]", 
    *      
    *      type="array",@OA\Items(type="string"),
    *  ),
    * 
    * 
    */
}
