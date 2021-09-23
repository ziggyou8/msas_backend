<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Models\Collectivite;
use App\Models\DistrictSanitaire;
use Illuminate\Http\Request;

class DistricteSanitaireController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/districtes",
     *   tags={"Districtes"},
     *   summary="List Districte ",
     *   operationId="List Districte",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Districte"),
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
        $structures = DistrictSanitaire::all();
        return $this->sendResponse(DistrictResource::collection($structures), "succés.");
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
     ** path="/v1/districtes",
     *   tags={"Districtes"},
     *   summary="Create districte",
     *   operationId="create districte",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="nom",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *  *  @OA\Parameter(
     *      name="collectivite_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
        $collectivite = Collectivite::find($request->id);
        if($collectivite ){
            return $this->sendError("Ce districte n'existe pas");
        }
        $districte = DistrictSanitaire::create($request->all());

        return $this->sendResponse(new DistrictResource($districte), "Districte ajouté avec succés.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     *  @OA\Get(
     **  path="/v1/districtes/{id}",
     *   tags={"Districtes"},
     *   summary="Detail Districte",
     *   operationId="Districte Detail",
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
     *      @OA\Property(ref="#/components/schemas/Districte"),
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
        $districte = DistrictSanitaire::find($id);
        if (!is_null($districte)) {
            return $this->sendResponse(new DistrictResource($districte), "succés.");
          } else {
            return $this->sendError("Ce districte n'existe pas");
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
     ** path="/v1/districtes/{id}",
     *   tags={"Districtes"},
     *   summary="Edit Districte",
     *   operationId="Edit Districte",
     *   security={{"bearerAuth": {}}},
     *
    *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
     *      )
     *  ),
     * 
     *  @OA\Parameter(
     *      name="nom",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      name="collectivite_id",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="integer"
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
        $districte = DistrictSanitaire::find($id);
        if (is_null($districte)) {
            return $this->sendError("Ce districte n'existe pas");
          } 
        $districte->nom =  $request->input("nom") ? $request->input("nom"): $districte->nom;
        $districte->collectivite_id =  $request->input("collectivite_id") ? $request->input("collectivite_id"): $districte->collectivite_id;
        $districte->save();

        return $this->sendResponse(new DistrictResource($districte), "Districte Modifié avec succés.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/v1/districtes/{id}",
     *   tags={"Districte"},
     *   summary="Delete Districte",
     *   operationId="delete Districte",
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
     *      @OA\Property(ref="#/components/schemas/Districte"),
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
    public function destroy($id)
    {
        $districte = DistrictSanitaire::find($id);
        if (is_null($districte)) {
            return $this->sendError("Ce districte n'existe pas");
          } 
        $districte->delete();
        return $this->sendResponse([], "Districte supprimé avec succés.");
    }
}
