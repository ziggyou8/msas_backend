<?php


namespace App\Repositories\Structures;

use App\Models\Structures\Etat;
use App\Repositories\ResourceRepository;

class EtatRepository extends ResourceRepository
{

    public function __construct(Etat $etat)
    {
        $this->model = $etat;
    }



}
