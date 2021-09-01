<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\SourceFinancementRessoure;
use App\Models\SourceFinancement;
use App\Models\TypeActeur;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Source;

class SourceFinancementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/financements",
     *   tags={"SourceFinancements"},
     *   summary="List SourceFinancements ",
     *   operationId="List SourceFinancements",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/SourceFinancement"),
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function index()
    {
        $financement = SourceFinancement::all();
        return $this->sendResponse(SourceFinancementRessoure::collection($financement), 'succés.');
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

     /**
     * @OA\Post(
     ** path="/v1/financements",
     *   tags={"SourceFinancements"},
     *   summary="Create SourceFinancement",
     *   operationId="create SourceFinancement",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="denomination",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="type_acteur[]",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="array",@OA\Items(type="string"),
     *      )
     *   ),
     * 
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */
    public function store(Request $request)
    {
        if( !$request->has('type_acteur')){
            return $this->sendError('Veuillez renseigner le champ type acteur');
        }
        $sourceFinance = new SourceFinancement();
        $sourceFinance->denomination  = $request->denomination;
        $sourceFinance->save();
        for ($i=0; $i < count($request->only('type_acteur')['type_acteur']); $i++) { 
            $acteur = new TypeActeur();
            $acteur->libelle = $request['type_acteur'][$i];
            $acteur->source_financement_id = $sourceFinance->id;
            $acteur->save();
        }

        return $this->sendResponse(new SourceFinancementRessoure($sourceFinance), 'Ajouté avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/financements/{id}",
     *   tags={"SourceFinancements"},
     *   summary="Detail SourceFinancement",
     *   operationId="SourceFinancement Detail",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/SourceFinancement"),
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function show($id)
    {
        $financement = SourceFinancement::find($id);
        if (!is_null($financement)) {
            return $this->sendResponse(new SourceFinancementRessoure($financement), 'succés.');
          } else {
            return $this->sendError('Ce financement n\'existe pas');
          }
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

     /**
     * @OA\Put(
     ** path="/v1/financements/{id}",
     *   tags={"SourceFinancements"},
     *   summary="Update SourceFinancement",
     *   operationId="Update SourceFinancement",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     * 
     *  @OA\Parameter(
     *      name="denomination",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * 
     *  @OA\Parameter(
     *      name="type_acteur[]",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="array",@OA\Items(type="string"),
     *      )
     *   ),
     * 
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     */
    public function update(Request $request, $id)
    {
            $sourceFinance = SourceFinancement::find($id);
            $sourceFinance->denomination  = $request->denomination ? $request->denomination : $sourceFinance->denomination;
            $sourceFinance->save();
        
        
        if($request->has('type_acteur')){
            TypeActeur::where('source_financement_id',$sourceFinance->id)->delete();
          
        for ($i=0; $i < count($request->only('type_acteur')['type_acteur']); $i++) { 
            $acteur = new TypeActeur();
            $acteur->libelle = $request['type_acteur'][$i];
            $acteur->source_financement_id = $sourceFinance->id;
            $acteur->save();
        }
        }
   
        return $this->sendResponse(new SourceFinancementRessoure($sourceFinance), 'Ajouté avec succés.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $financement = SourceFinancement::find($id);
        $financement->delete();
        return $this->sendResponse([], 'Supprimé avec succés.');
    }
}
