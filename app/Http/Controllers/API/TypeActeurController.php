<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeActeurResource;
use App\Models\TypeActeur;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;

class TypeActeurController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/v1/acteurs",
     *   tags={"Acteur"},
     *   summary="List Acteurs ",
     *   operationId="List Acteurs",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Acteur"),
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
        $acteurs = TypeActeur::orderBy('id','DESC')->get();
        return $this->sendResponse(TypeActeurResource::collection($acteurs), 'succés.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/v1/acteurs",
     *   tags={"Acteur"},
     *   summary="Create Acteur",
     *   operationId="create Acteur",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="libelle",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      name="source_financement_id",
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
        /* $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_id' => 'required',
        ]); */
    
        $acteur = TypeActeur::create([
            'libelle' => $request->input('libelle'),
            'source_financement_id' => $request->input('source_financement_id')
        ]);

        return $this->sendResponse(new TypeActeurResource($acteur), 'Role ajouté avec succés.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/acteurs/{id}",
     *   tags={"Acteur"},
     *   summary="Detail Acteur",
     *   operationId="Acteur Detail",
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
     *      @OA\Property(ref="#/components/schemas/Acteur"),
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
        $acteur = TypeActeur::find($id);
        if (!is_null($acteur)) {
            return $this->sendResponse(new TypeActeurResource($acteur), 'succés.');
          } else {
            return $this->sendError('Cet acteur n\'existe pas');
          }
    }


     /**
     * @OA\Get(
     ** path="/v1/acteurs-by-financement/{id}",
     *   tags={"Acteur"},
     *   summary=" Acteur by source de financement",
     *   operationId="List Acteur",
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
     *      @OA\Property(ref="#/components/schemas/Acteur"),
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
    public function ActeurByFinancement($id)
    {
        $acteur = TypeActeur::where('source_financement_id',$id)->get();
        if (!is_null($acteur)) {
            return $this->sendResponse(TypeActeurResource::collection($acteur), 'succés.');
          } else {
            return $this->sendError('Cet acteur n\'existe pas');
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
     ** path="/v1/acteurs/{id}",
     *   tags={"Acteur"},
     *   summary="Edit acteur",
     *   operationId="Edit acteur",
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
     *      name="libelle",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     *  @OA\Parameter(
     *      name="source_financement_id",
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
        /* $this->validate($request, [
            'nom' => 'required',
            'permission' => 'required',
        ]); */
        
        $acteur = TypeActeur::find($id);
        if (is_null($acteur)) {
            return $this->sendError('Cet acteur n\'existe pas');
          } 
        $acteur->libelle =  $request->input('libelle') ? $request->input('libelle'): $acteur->libelle;
        $acteur->source_financement_id =  $request->input('source_financement_id') ? $request->input('source_financement_id'): $acteur->source_financement_id;
        $acteur->save();

        return $this->sendResponse(new TypeActeurResource($acteur), 'Acteur Modifié avec succés.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/v1/acteurs/{id}",
     *   tags={"Acteur"},
     *   summary="Delete Acteur",
     *   operationId="delete Acteur",
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
     *      @OA\Property(ref="#/components/schemas/Acteur"),
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
        $acteur = TypeActeur::find($id);
        if (is_null($acteur)) {
            return $this->sendError('Cet acteur n\'existe pas');
          } 
        $acteur->delete();
        return $this->sendResponse([], 'Acteur supprimé avec succés.');
    }
}
