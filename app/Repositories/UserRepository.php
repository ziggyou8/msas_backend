<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\ResourceRepository;

class UserRepository extends ResourceRepository
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }



}
