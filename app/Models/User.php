<?php

namespace App\Models;

use App\Models\Structures\Structure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;
    

   /*  public function structures(){
        return $this->belongsToMany(Structure::class,"structures_users");
   } */
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "photo",
        "prenom",
        "nom",
        "telephone",
        "email",
        "password",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "password",
        "remember_token",
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    /**
    * @OA\Property(
    *      property="id", 
    *      type="integer", 
    *  ),

    * @OA\Property(
    *      property="photo",
    *      type="string",
    * ),

    * @OA\Property(
    *      property="prenom", 
    *      type="string",  
    *  ),

     * @OA\Property(
     *      property="nom",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="telephone",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="email",
     *      type="string", 
     * ),
     * @OA\Property(
     *      property="structure_id[]", 
     *      type="array",@OA\Items(type="integer"),
     *  ),
     * 
     * @OA\Property(
     *      property="role",
     *      type="string", 
     * ),
     * 
     * @OA\Property(
     *      property="password",
     *      type="string",
     * ),
     * 
     * @OA\Property(
     *      property="c_password",
     *      type="string",
     * ),
     * 
     */
}
