<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvestissementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "annee" => $this->annee,
            "monnaie"=> $this->monnaie,
            "comments"=> $this->comments,
            "statut"=> $this->statut,
            "piliers"=> $this->piliers,
            "mode_financement"=>$this->mode_financement,
            'structure'=>$this->structure

        ];
    }
}
