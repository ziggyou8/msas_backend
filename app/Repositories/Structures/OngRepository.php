<?php


namespace App\Repositories\Structures;

use App\Models\Structures\Ong;
use App\Repositories\ResourceRepository;

class OngRepository extends ResourceRepository
{

    public function __construct(Ong $ong)
    {
        $this->model = $ong;
    }



}
