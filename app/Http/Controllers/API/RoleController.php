<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/v1/roles",
     *   tags={"Roles"},
     *   summary="List Roles ",
     *   operationId="List Roles",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/Role"),
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
        $roles = Role::orderBy('id','DESC')->get();
        return $this->sendResponse(RoleResource::collection($roles), 'succés.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Post(
     ** path="/v1/roles",
     *   tags={"Roles"},
     *   summary="Create Role",
     *   operationId="create Role",
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
     *  @OA\Parameter(
     *      name="permission_id[]",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="array",@OA\Items(type="integer"),
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
    
        $role = Role::create(['name' => $request->input('nom')]);
        
        $role->syncPermissions($request->only('permission_id'));

        return $this->sendResponse(new RoleResource($role), 'Role ajouté avec succés.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/roles/{id}",
     *   tags={"Roles"},
     *   summary="Detail Role",
     *   operationId="Role Detail",
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
     *      @OA\Property(ref="#/components/schemas/Role"),
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
        $role = Role::find($id);
        if (!is_null($role)) {
            return $this->sendResponse(new RoleResource($role), 'succés.');
          } else {
            return $this->sendError('Ce role n\'existe pas');
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
     ** path="/v1/roles/{id}",
     *   tags={"Roles"},
     *   summary="Edit Role",
     *   operationId="Edit Role",
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
     *  @OA\Parameter(
     *      name="permission_id[]",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *          type="array",@OA\Items(type="integer"),
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
        
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('Ce role n\'existe pas');
          } 
        $role->name =  $request->input('nom') ? $request->input('nom'): $role->name;
        $role->save();
        $role->syncPermissions($request->input('permission_id'));

        return $this->sendResponse(new RoleResource($role), 'Role Modifié avec succés.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/v1/roles/{id}",
     *   tags={"Roles"},
     *   summary="Delete Role",
     *   operationId="delete Role",
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
     *      @OA\Property(ref="#/components/schemas/Role"),
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
        $role = Role::find($id);
        if (is_null($role)) {
            return $this->sendError('Ce role n\'existe pas');
          } 
        $role->delete();
        return $this->sendResponse([], 'Role supprimé avec succés.');
    }
}
