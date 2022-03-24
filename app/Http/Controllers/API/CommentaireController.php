<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CommentaireRepository;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    protected $commentaireRepository;
    public function __construct(CommentaireRepository $commentaireRepository)
                                
    {
        $this->commentaireRepository = $commentaireRepository;
        
        //$this->middleware("auth");
        // $this->middleware("permission:structure-list|structure-create", ["only" => ["index","store"]]);
    }


    
}
