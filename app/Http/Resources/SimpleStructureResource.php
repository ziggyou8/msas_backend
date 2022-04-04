<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SimpleStructureResource extends JsonResource
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
            "id" => $this->id,
            "denomination" => $this->denomination,
            "type_acteur" => $this->type_acteur,
            "source_financement" => $this->source_financement,
            "prenom_responsable" => $this->prenom_responsable,
            "nom_responsable" => $this->nom_responsable,
            "telephone_responsable" => $this->telephone_responsable,
            "email_responsable" => $this->email_responsable,
            "telephone_responsable" => $this->telephone_responsable,
            "fonction_responsable" => $this->fonction_responsable,
        ];
    }
}
