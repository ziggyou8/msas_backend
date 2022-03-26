<?php

namespace App\Http\Resources;

use App\Enums\Profil;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeInformationRessource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'profil' => Profil::getDescription($this->profil),
            'precision_profil' => $this->precision_profil,
            'besoin' => $this->besoin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
