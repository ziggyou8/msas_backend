<?php


namespace App\Repositories;

use App\Enums\Profil;
use App\Models\DemandeInformation;

class DemandeInformationRepository extends ResourceRepository
{

    public function __construct(DemandeInformation $demandeInformation)
    {
        $this->model = $demandeInformation;
    }

    public function getProfil()
    {
        return Profil::toSelectArray();
    }

    public function getPaginateByStructure($idStructure, $n)
    {
        return $this->model->where('structure_id', $idStructure)->paginate($n);
    }

    public function changeStatus($id, $inputs)
    {
        $demande = $this->getById($id);
        $demande->traitee_par = $inputs['user_id'];
        $demande->date_traitement = $inputs['date_traitement'];
        $demande->code_etat = $inputs['etat'];
        return $demande->save();
    }

    public function updateStructure($id, $idStructure)
    {
        $demande = $this->getById($id);
        $demande->structure_id = $idStructure;
        return $demande->save();
    }

}
