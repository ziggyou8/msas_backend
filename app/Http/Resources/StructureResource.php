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
            "type_acteur" => $this->type_acteur,
            "source_financement"=>$this->source_financement,
            "telephone_siege"=>$this->telephone_siege,
            "autre_secteur_intervention"=>$this->autre_secteur_intervention,
            "paquet_sante_intervention"=>$this->paquet_sante_intervention,
            "region_intervention"=>$this->region_intervention,
            "departement_intervention"=>$this->departement_intervention,
            "commune_intervention"=>$this->commune_intervention,
            "districte_intervention"=>$this->districte_intervention,
            "mobilisation_ressource"=>$this->mobilisation_ressource,
            "mis_en_commun_ressource"=>$this->mis_en_commun_ressource,
            "achat_service"=>$this->achat_service,
            "adresse_siege"=>$this->adresse_siege,
            "email_siege"=>$this->email_siege,
            "latitude"=>$this->latitude,
            "longitude"=>$this->longitude,
            "prenom_responsable"=>$this->prenom_responsable,
            "nom_responsable"=>$this->nom_responsable,
            "telephone_responsable"=>$this->telephone_responsable,
            "email_responsable"=>$this->email_responsable,
            "telephone_responsable"=>$this->telephone_responsable,
             "infos_suplementaires"=>$this->acteurType()
           // "acteur_".strtolower($this->type_acteur)=>$this->acteur
        ];
    }
}
