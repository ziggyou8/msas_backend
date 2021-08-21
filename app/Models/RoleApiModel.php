<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role model",
 *     @OA\Xml(
 *         name="Role"
 *     )
 * )
 */
class RoleApiModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),

    * @OA\Property(
    *      property="nom",
    *      type="string",
    * ),
    * @OA\Property(
    *      property="permission_id[]", 
    *      type="array",@OA\Items(type="integer"),
    *  ),
    * 
    */
}


