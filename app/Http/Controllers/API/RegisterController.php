<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/* use Validator; */

class RegisterController extends BaseController
{
    public function __construct()
    {
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/v1/register",
     *   tags={"Auth"},
     *   summary="Register",
     *   operationId="register",
     *
     *  @OA\Parameter(
     *      name="nom",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="prenom",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="telephone",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *
     *   @OA\Parameter(
     *      name="c_password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "prenom" => "required",
            "telephone" => "required",
            "email" => "required|email",
            "password" => "required",
            "c_password" => "required|same:password",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        $user = User::create($input);
        $success["token"] = $user->createToken("MyApp")->accessToken;
        $success["id"] = $user->id;
        $success["prenom"] = $user->prenom;
        $success["nom"] = $user->nom;
        $success["email"] = $user->email;
        $success["telephone"] = $user->telephone;

        return $this->sendResponse($success, "User register successfully.");
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     ** path="/v1/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *
     *   @OA\Parameter(
     *      name="email",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
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
     **/
    public function login(Request $request)
    {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password]) && Auth::user()->actif) {
            $user = Auth::user();
            $success["token"] = $user->createToken("MyApp")->accessToken;
            $success["id"] = $user->id;
            $success["prenom"] = $user->prenom;
            $success["nom"] = $user->nom;
            $success["email"] = $user->email;
            $success["telephone"] = $user->telephone;
            $success["roles"] = $user->getRoleNames();

            return $this->sendResponse($success, "User login successfully.");
        } else {
            return $this->sendError("Unauthorised.", ["error" => "Unauthorised"]);
        }
    }


    /**
     * @OA\Post(
     ** path="/v1/logout",
     *   tags={"Auth"},
     *   summary="logout",
     *   operationId="logoutUser",
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

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response(["message" => "Deconnection avec succés"], 200);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->sendResponse([], 'Mot de passe réinitialisé avec succés')
            : $this->sendError('Erreur', ['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->sendResponse([], 'Mot de passe réinitialisé avec succés')
            : $this->sendError('Erreur', ['email' => [__($status)]]);
    }

}
