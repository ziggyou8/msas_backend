<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $users = User::all()->where('id', '!=', Auth::user()->id);
        // $users = User::whereDoesntHave("admin")->get();

        return $this->sendResponse(UserRessource::collection($users), "succés.");
    }

    public function est_actif($id)
    {
        $user = User::find($id);
        $user->actif = !$user->actif;
        $user->save();
        return $this->sendResponse(new UserRessource($user), $user->actif ? 'Utilisateur activé avec succés.' : 'Utilisateur désactivé avec succés.');
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $password = bin2hex(openssl_random_pseudo_bytes(4));
        $input["password"] = bcrypt($password);
        $validator = Validator::make($input, ["prenom" => "required", "nom" => "required",
            "email" => "required|unique:users,email,NULL,id"]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        $user = User::create($input);
        if (Auth::user()->roles[0]->name === "Admin_DPRS") {
            $user->structure_id = $request->structure_id ?? null;
            $user->assignRole($request->role);
            $user->save();
        } else {
            $user->structure_id = Auth::user()->structure_id;
            $user->assignRole("Point_focal");
            $user->save();
        }

        $details = [
            'email' => $request->email,
            'full_name' => $user->prenom . ' ' . $user->nom,
            'structure_name' => $user->structure->denomination ?? null,
            'password' => $password
        ];

        try {
            Mail::to($user->email)->send(new \App\Mail\CreatedAcountMailer($details));
        } catch (\Throwable $th) {
            return $this->sendError("Connexion faible!! Essayez de vous reconnecter");
        }

        return $this->sendResponse(new UserRessource($user), "Utilisateur ajouté avec succés.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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

    public function users_by_structure($id)
    {
        $users = User::where('structure_id', $id)->where('id', '!=', Auth::user()->id)->get();

        return $this->sendResponse(UserRessource::collection($users), "succés.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->photo = $request->photo ? $request->photo : $user->photo;
        $user->prenom = $request->prenom ? $request->prenom : $user->prenom;
        $user->nom = $request->nom ? $request->nom : $user->nom;
        $user->telephone = $request->telephone ? $request->telephone : $user->telephone;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? bcrypt($request->password) : $user->password;
        $user->save();
        $request->role && $user->syncRoles($request->role);
        $request->structure_id && $user->structures()->sync($request->only("structure_id")["structure_id"]);

        return $this->sendResponse(new UserRessource($user), "Modifié avec succès.");
    }

    public function profileUpdate(Request $request)
    {
        DB::beginTransaction();
        $success = false;
        try {
            $user = User::find(Auth::user()->id);
            $user->photo = $request->photo ? $request->photo : $user->photo;
            $user->prenom = $request->prenom ? $request->prenom : $user->prenom;
            $user->nom = $request->nom ? $request->nom : $user->nom;
            $user->telephone = $request->telephone ? $request->telephone : $user->telephone;
            $user->email = $request->email ? $request->email : $user->email;
            $user->save();

            $success = true;
            if ($success) {
                DB::commit();
            }
            return $this->sendResponse(new UserRessource($user), "Profile modifié avec succés.");
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
            return $this->sendError("Erreur! Réessayez svp");
        }
    }


    public function passwordUpdate(Request $request)
    {

        try {
            $user = User::find(Auth::user()->id);

            if (!Hash::check($request->old_password, $user->password)) {
                return $this->sendError("Ancien mot de passe incorrect");
            }

            if ($request->password !== $request->confirm_password) {
                return $this->sendError("Les mots de passe ne correspondent pas");
            }

            /* $user->password = $request->password ? bcrypt($request->password) : $user->password; */
            $user->update([
                "password"=>$request->password ? bcrypt($request->password) : $user->password
            ]);
            return $this->sendResponse(new UserRessource($user), "Mot de passe modifié avec succés.");
        } catch (\Exception $e) {
            return $this->sendError("Erreur! Réessayez svp");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
    public function get_current_user(Request $request)
    {
        return $this->sendResponse(new UserRessource($request->user()), "succés.");
    }
}
