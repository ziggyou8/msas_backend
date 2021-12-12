<?php


namespace App\Repositories;

use App\Models\Investissement;
use App\Models\User;
use App\Repositories\ResourceRepository;

class InvestissementRepository extends ResourceRepository
{

    public function __construct(Investissement $investissement)
    {
        $this->model = $investissement;
    }



}
