<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\UserRessource;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
    
        return $this->sendResponse(UserRessource::collection($users), 'succés.');
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
        $input = $request->all();
        $input['password'] = bcrypt("passer");

        $validator = Validator::make($input, [
            'nom_complet' => 'required',
            'email' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $user = User::create($input);
   
        return $this->sendResponse(new UserRessource($user), 'Utilisateur ajouté avec succés.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            return $this->sendResponse(new UserRessource($user), 'succés.');
          } else {
            return $this->sendError('Cet utilisateur n\'existe pas');
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
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        $input = $request->all();
        $user->nom_complet =  $request->nom_complet ? $request->nom_complet : $user->nom_complet;
        $user->telephone = $request->telephone ? $request->telephone : $user->telephone;
        $user->email = $request->email ? $request->email : $user->email;
        $user->password = $request->password ? bcrypt($request->password ) : $user->password;
        $user->save();
        return $this->sendResponse(new UserRessource($user), 'succés.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return $this->sendResponse([], 'Utilisateur supprimé avec succés.');
    }
}
