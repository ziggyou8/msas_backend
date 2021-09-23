<?php


namespace App\Repositories\Structures;

use App\Models\Structures\Ptf;
use App\Repositories\ResourceRepository;

class PtfRepository extends ResourceRepository
{

    public function __construct(Ptf $ptf)
    {
        $this->model = $ptf;
    }



}
