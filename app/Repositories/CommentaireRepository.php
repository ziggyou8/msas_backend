<?php


namespace App\Repositories;

use App\Models\Commentaire;
use App\Repositories\ResourceRepository;

class CommentaireRepository extends ResourceRepository
{

    public function __construct(Commentaire $commentaire)
    {
        $this->model = $commentaire;
    }



}
