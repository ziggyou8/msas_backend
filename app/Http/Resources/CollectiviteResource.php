<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectiviteResource extends JsonResource
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
            "nom" => $this->nom,
            "code"=> $this->code,
            "type_collectivite"=> $this->type_collectivite,
            "parent_code"=> $this->parent_code,
        ];
    }
}
