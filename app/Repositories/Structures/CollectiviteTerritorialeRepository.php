<?php


namespace App\Repositories\Structures;

use App\Models\Structures\CollectiviteTerritoriale;
use App\Repositories\ResourceRepository;

class CollectiviteTerritorialeRepository extends ResourceRepository
{

    public function __construct(CollectiviteTerritoriale $collectiviteTerritoriale)
    {
        $this->model = $collectiviteTerritoriale;
    }



}
