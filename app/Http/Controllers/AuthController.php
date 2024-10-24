<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Mail\PasswordRecoveryMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Str;

class AuthController extends Controller
{
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request): User|JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $request['password'] = (string) bcrypt($request->password);

        return User::create($request->all());
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Find user by email.
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    protected function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Update password.
     * 
     * @return \Illuminate\Http\JsonResponse
     * 
     */
    public function updatePassword(UserRequest $request): User|JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        /*
        *   verificar si el usuario existe
        */
        $user = $this->findUserByEmail($request->email);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        /*
        *   verificar si el token es de un usuario loggeado
        */
        if (auth()->user()->email == null) {
            return response()->json(['message' => 'Acceso denegado.'], 401);
        }

        $userLog = auth()->user()->email;

        /*
        *   verificar si el usuario loggeado y el que modifica la contraseña es el mismo 
        */
        if ($user->email != $userLog) {
            return response()->json(['message' => 'Acceso denegado.'], 401);
        }

        /*
        *   verificar si la contraseña es correcta
        */
        if (! Hash::check($request->old_password, $user->password)) {
            return response()->json(['message' => 'Contraseña incorrecta.'], status: 401);
        }

        /*
        *   verificar si la nueva contraseña es igual a la anterior
        */
        if (Hash::check($request->new_password, $user->password)) {
            return response()->json(['message' => 'La nueva contraseña no debe ser igual a la anterior.'], 422);
        }

        /*
        *   actualizar la contraseña
        */
        try {
            // Crea una nueva instancia de la clase Request con la nueva contraseña
            $user->password = (string) bcrypt($request->new_password);
            // Actualiza la contraseña del usuario
            $user->save();
            return response()->json(['message' => 'Contraseña actualizada con éxito.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /*
    *   Recuperar contraseña
    */
    public function recoverPassword(UserRequest $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = $this->findUserByEmail($request->email);

        if ($user) {
            $temp_password = Str::random(8);
            $user->password = bcrypt($temp_password);
            $user->save();

            // Mail::to($user->email)->send(new PasswordRecoveryMail($temp_password));
            return response()->json(['message' => 'Se ha enviado un correo.'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }
    }
}
