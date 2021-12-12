<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvestissementResource;
use App\Models\Investissement;
use App\Repositories\InvestissementRepository;
use Illuminate\Http\Request;

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
        if (!is_null($investissement)) {
            return $this->sendResponse(new InvestissementResource($investissement), "succés.");
          } else {
            return $this->sendError("Investissement introuvable");
          }
;
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
