<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     ** path="/v1/users",
     *   tags={"Users"},
     *   summary="List Users ",
     *   operationId="List Users",
     *  security={{"bearerAuth": {}}},
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/User"),
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
        $users = User::all();
       // $users = User::whereDoesntHave("admin")->get();
    
        return $this->sendResponse(UserRessource::collection($users), "succés.");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/v1/users",
     *   tags={"Users"},
     *   summary="Create User",
     *   operationId="create User",
     *   security={{"bearerAuth": {}}},
     *
     *  @OA\Parameter(
     *      name="prenom",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="nom",
     *      in="query",
     *      required=true, 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="photo",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *    @OA\Parameter(
     *      name="structure_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      name="role",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * *  @OA\Parameter(
     *      name="structure_id[]",
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
        $input = $request->all();
        $input["password"] = bcrypt("passer");

        $validator = Validator::make($input, [
            "prenom" => "required",
            "nom" => "required",
            "email" => "required"
        ]);
   
        if($validator->fails()){
            return $this->sendError("Validation Error.", $validator->errors());       
        }
          
        $user = User::create($input);
        $request->role && $user->assignRole($request->role);
        $request->structure_id && $user->structures()->attach($request->only("structure_id")["structure_id"]);

       /*  if($request->structure_id){
            $user->structures()->attach($request->only("structure_id")["structure_id"]);
        } */

        return $this->sendResponse(new UserRessource($user), "Utilisateur ajouté avec succés.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     ** path="/v1/users/{id}",
     *   tags={"Users"},
     *   summary="Detail User",
     *   operationId="User Detail",
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
     *      @OA\Property(ref="#/components/schemas/User"),
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
        $user = User::find($id);
        if (!is_null($user)) {
            return $this->sendResponse(new UserRessource($user), "succés.");
          } else {
            return $this->sendError("Cet utilisateur n'existe pas");
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
     ** path="/v1/users/{id}",
     *   tags={"Users"},
     *   summary="Update User",
     *   operationId="Update User",
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
     *      name="prenom",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * 
     * @OA\Parameter(
     *      name="nom",
     *      in="query",
     *      required=false, 
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="telephone",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="email",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="photo",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="structure_id",
     *      in="query",
     *      @OA\Schema(
     *           type="integer"
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      name="role",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
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
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $user->photo =  $request->photo ? $request->photo : $user->photo;
        $user->prenom =  $request->prenom ? $request->prenom : $user->prenom;
        $user->nom =  $request->nom ? $request->nom : $user->nom;
        $user->telephone = $request->telephone ? $request->telephone : $user->telephone;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? bcrypt($request->password ) : $user->password;
        $user->save();
        $request->role && $user->syncRoles($request->role);
        $request->structure_id && $user->structures()->sync($request->only("structure_id")["structure_id"]);
        
        return $this->sendResponse(new UserRessource($user), "succés.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     ** path="/v1/users/{id}",
     *   tags={"Users"},
     *   summary="Delete User",
     *   operationId="delete User",
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
     *      @OA\Property(ref="#/components/schemas/User"),
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
        $user = User::find($id);
        $user->delete();
        return $this->sendResponse([], "Utilisateur supprimé avec succés.");
    }

    /**
     * @OA\Get(
     ** path="/v1/user",
     *   tags={"Users"},
     *   summary="Get CurrentUser",
     *   operationId="Get Current User",
     *  security={{"bearerAuth": {}}},
     *
     *
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\Property(ref="#/components/schemas/User"),
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
    public function get_current_user(Request $request){
        return $this->sendResponse(new UserRessource($request->user()), "succés.");
    }
}
