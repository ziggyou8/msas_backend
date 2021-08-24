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
            'type_fonds' =>  $this->type_fonds,
            'telephone' =>  $this->telephone,
            'prenom_personne_responsable' =>  [
                $this->prenom_personne_responsable,
                $this->nom_personne_responsable,
                $this->email_personne_responsable,
                $this->telephone_personne_responsable,
            ], 
            'source_financement' => $this->sourceFiancement,
            //'source_financement' => SourceFinancement::where('id',$this->source_financement_id)->pluck('denomination')->first(),
            //'source_financement' =>  SourceFinancement::with('acteurs')->where('id', $this->id)->get(),
            //'type_acteurs' =>  $this->sourceFiancement->with('acteurs'),
        ];
    }
}
