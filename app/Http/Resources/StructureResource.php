<?php

namespace App\Http\Resources;

use App\Enums\TypeActeur as EnumsTypeActeur;
use App\Models\SourceFinancement;
use App\Models\TypeActeur;
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
            "id" => $this->id,
            "denomination" => $this->denomination,
            "interventions" => $this->regionInterventions,
            "type_acteur" => $this->type_acteur,
            "source_financement"=>$this->source_financement,
            "telephone_siege"=>$this->telephone_siege,
            "secteur_intervention"=>$this->secteur_intervention,
            "mobilisation_ressource"=>$this->mobilisation_ressource,
            "mis_en_commun_ressource"=>$this->mis_en_commun_ressource,
            "achat_service"=>$this->achat_service,
            "adresse_siege"=>$this->adresse_siege,
            "email_siege"=>$this->email_siege,
            "latitude"=>$this->latitude,
            "longitude"=>$this->longitude,
            "altitude"=>$this->altitude,
            "prenom_responsable"=>$this->prenom_responsable,
            "nom_responsable"=>$this->nom_responsable,
            "telephone_responsable"=>$this->telephone_responsable,
            "email_responsable"=>$this->email_responsable,
            "telephone_responsable"=>$this->telephone_responsable,
            "fonction_responsable"=>$this->fonction_responsable,
            "investissements"=>$this->investissements,
            "accord_siege"=>$this->accord_siege,
            "date_debut_intervention"=>$this->debut_intervention,
            "date_fin_intervention"=>$this->date_fin_intervention,

        ];
    }
}
