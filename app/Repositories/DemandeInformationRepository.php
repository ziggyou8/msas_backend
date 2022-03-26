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

}
