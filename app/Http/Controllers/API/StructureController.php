<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\StructureResource;
use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends BaseController
{
    function __construct()
    {
        // $this->middleware('permission:structure-list|structure-create', ['only' => ['index','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/structures",
     *   tags={"Structures"},
     *   summary="List Structures ",
     *   operationId="List Structures",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Structures"),
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
        $structures = Structure::all();
        return $this->sendResponse(StructureResource::collection($structures), 'succés.');
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
     ** path="/v1/structures",
     *   tags={"Structures"},
     *   summary="Create Structure",
     *   operationId="create Structure",
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
     *      name="addresse_siege",
     *      in="query",
     *      required=true, 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="type_fonds",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="prenom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="nom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="source_financement_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="type_acteur_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
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
        $structurre = new Structure();
        $structurre->denomination  = $request->denomination;
        $structurre->logo  = $request->logo;
        $structurre->type_fonds  = $request->type_fonds;
        $structurre->telephone  = $request->telephone;
        $structurre->addresse_siege  = $request->addresse_siege;
        $structurre->source_financement_id  = $request->source_financement_id;
        $structurre->type_acteur_id  = $request->type_acteur_id;
        $structurre->prenom_personne_responsable  = $request->prenom_personne_responsable;
        $structurre->nom_personne_responsable  = $request->nom_personne_responsable;
        $structurre->telephone_personne_responsable  = $request->telephone_personne_responsable;
        $structurre->email_personne_responsable  = $request->email_personne_responsable;
        $structurre->save();

        return $this->sendResponse(new StructureResource($structurre), 'Ajouté avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Detail Structure",
     *   operationId="Structure Detail",
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
     *      @OA\Property(ref="#/components/schemas/Structure"),
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
        $structure = Structure::find($id);
        if (!is_null($structure)) {
            return $this->sendResponse(new StructureResource($structure), 'succés.');
          } else {
            return $this->sendError('Cette structure n\'existe pas');
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
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Update Structure",
     *   operationId="update Structure",
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
     *  @OA\Parameter(
     *      name="denomination",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="addresse_siege",
     *      in="query", 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="type_fonds",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="prenom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="nom_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="type_acteur_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone_personne_responsable",
     *      in="query",
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="source_financement_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
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
        $structurre = Structure::find($id);
        $structurre->denomination  = $request->denomination ? $request->denomination :$structurre->denomination;
        $structurre->logo  = $request->logo ? $request->logo :$structurre->logo;
        $structurre->type_fonds  = $request->type_fonds ? $request->type_fonds :$structurre->type_fonds;
        $structurre->telephone  = $request->telephone ? $request->telephone :$structurre->telephone;
        $structurre->addresse_siege  = $request->addresse_siege ? $request->addresse_siege :$structurre->addresse_siege;
        $structurre->source_financement_id  = $request->source_financement_id ? $request->source_financement_id :$structurre->source_financement_id;
        $structurre->type_acteur_id  = $request->type_acteur_id ? $request->type_acteur_id :$structurre->type_acteur_id;
        $structurre->prenom_personne_responsable  = $request->prenom_personne_responsable ? $request->prenom_personne_responsable :$structurre->prenom_personne_responsable;
        $structurre->nom_personne_responsable  = $request->nom_personne_responsable ? $request->nom_personne_responsable :$structurre->nom_personne_responsable;
        $structurre->telephone_personne_responsable  = $request->telephone_personne_responsable ? $request->telephone_personne_responsable :$structurre->telephone_personne_responsable;
        $structurre->email_personne_responsable  = $request->email_personne_responsable ? $request->email_personne_responsable :$structurre->email_personne_responsable;
        $structurre->save();

        return $this->sendResponse(new StructureResource($structurre), 'succés.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

      /**
     * @OA\Delete(
     ** path="/v1/structures/{id}",
     *   tags={"Structures"},
     *   summary="Delete Structure",
     *   operationId="delete Structure",
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
     *      @OA\Property(ref="#/components/schemas/Structure"),
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
        $structure = Structure::find($id);
        $structure->delete();
        return $this->sendResponse([], 'Structure supprimé avec succés.');
    }
}
