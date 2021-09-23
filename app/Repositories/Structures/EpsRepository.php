<?php


namespace App\Repositories\Structures;

use App\Models\Structures\Eps;
use App\Repositories\ResourceRepository;

class EpsRepository extends ResourceRepository
{

    public function __construct(Eps $eps)
    {
        $this->model = $eps;
    }



}
