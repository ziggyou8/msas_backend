<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentaireRessource;
use App\Http\Resources\InvestissementResource;
use App\Models\Commentaire;
use App\Models\Investissement;
use App\Repositories\InvestissementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestissementControler extends BaseController
{
    protected $investissementRepository;
    public function __construct(InvestissementRepository $investissementRepository)
                                
    {
        $this->investissementRepository = $investissementRepository;
        
        //$this->middleware("auth");
        // $this->middleware("permission:structure-list|structure-create", ["only" => ["index","store"]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investissements = $this->investissementRepository->getData();

        return $this->sendResponse(InvestissementResource::collection($investissements), "succés.");
    }


    public function investissement_by_structure($id)
    {
        $investissements = Investissement::where('structure_id', $id)->get();

        return $this->sendResponse(InvestissementResource::collection($investissements), "succés.");
    }

    public function investissement_validation($id)
    {
        
        function getStatutValidation (){
            $statuts =[
                "Admin_DPRS" => "Valider",
                "Admin_structure" => "Prévalider",
                "Point_focal" => "En attente de validation",
            ];
            return $statuts[Auth::user()->roles[0]->name];
        }

        $investissement = Investissement::find($id);
        if(!$investissement){
            return $this->sendError("Investissement inexistant");
        }

        $investissement->statut = getStatutValidation();
        $investissement->save();
        return $this->sendResponse(new InvestissementResource($investissement), "succés.");
    }

    public function investissement_rejection(Request $request, $id)
    {
        
        function getStatutRejection (){
            $statuts =[
                "Admin_DPRS" => "Rejet DPRS",
                "Admin_structure" => "Rejet Structure",               
            ];
            return $statuts[Auth::user()->roles[0]->name];
        }

        $investissement =  $investissement = Investissement::find($id);;
        $investissement->statut = getStatutRejection();
        $investissement->save();

        $commentaire = Commentaire::create([
            "investissement_id" => $id,
            "user_id" => Auth::user()->id,
            "description" => $request->description,
        ]);
        $commentaire->save();


        return $this->sendResponse(new InvestissementResource($investissement), "succés.");
    }

   /*  public function comment(Request $request,$investissement_id)
    {
        $commentaire = Commentaire::create([
            "investissement_id" => $investissement_id,
            "description" => $request->description,
        ]);
        $commentaire->save();
        return $this->sendResponse(new CommentaireRessource($commentaire), "succés.");
    } */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $investissement = Investissement::find($id);
        if(!is_null($investissement)) {
            return $this->sendResponse(new InvestissementResource($investissement), "succés.");
          }else {
            return $this->sendError("Investissement introuvable");
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
