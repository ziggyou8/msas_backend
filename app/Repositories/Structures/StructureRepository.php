<?php


namespace App\Repositories\Structures;
use App\Models\Structures\Structure;
use App\Repositories\ResourceRepository;

class StructureRepository extends ResourceRepository
{

    public function __construct(Structure $structure)
    {
        $this->model = $structure;
    }



}
