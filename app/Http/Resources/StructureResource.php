<?php

namespace App\Http\Resources;

use App\Models\SourceFinancement;
use Illuminate\Http\Resources\Json\JsonResource;

class StructureResource extends JsonResource
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
            'id' => $this->id,
            'denomination' => $this->denomination,
            'addresse_siege' =>  $this->addresse_siege,
            'telephone' =>  $this->telephone,
            'source_financement' =>  SourceFinancement::with('acteurs')->where('id', $this->id)->get(),
            //'type_acteurs' =>  $this->sourceFiancement->with('acteurs'),
        ];
    }
}
