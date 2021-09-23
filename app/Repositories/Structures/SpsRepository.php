<?php


namespace App\Repositories\Structures;

use App\Models\Structures\Sps;
use App\Repositories\ResourceRepository;

class SpsRepository extends ResourceRepository
{

    public function __construct(Sps $sps)
    {
        $this->model = $sps;
    }



}
