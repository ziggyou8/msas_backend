<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserRessource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "photo" => $this->photo,
            "prenom" => $this->prenom,
            "nom" => $this->nom,
            "telephone" => $this->telephone,
            "email" => $this->email,
            "actif" => $this->actif,
            "status"=>$this->estActif(),
            "roles"=> [$this->roles[0]->libelle,$this->roles[0]->name],
            "structure"=>$this->structure,
            "permission"=>$this->getPermissionsViaRoles()->pluck("name"),
            "created_at" => $this->created_at->format("d/m/Y"),
            "updated_at" => $this->updated_at->format("d/m/Y"),
        ];
    }
}
