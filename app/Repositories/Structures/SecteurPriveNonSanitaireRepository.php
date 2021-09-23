<?php


namespace App\Repositories\Structures;
use App\Models\Structures\SecteurPriveNonSanitaire;
use App\Repositories\ResourceRepository;

class SecteurPriveNonSanitaireRepository extends ResourceRepository
{

    public function __construct(SecteurPriveNonSanitaire $secteurPriveNonSanitaire)
    {
        $this->model = $secteurPriveNonSanitaire;
    }



}
