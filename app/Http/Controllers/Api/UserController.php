<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Js;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = User::all();

        if ($user->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): User
    {
        return User::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): User
    {   
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        return response()->json([$request->validated()], 200);
        // $user->update($request->validated());

        // return $user;
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    public function getWorkers()
    {
        $workers = User::where("acounttype_id", 3)->get();

        if ($workers->count() == 0) {
            return response()->json([
                "message" => "No workers found",
            ], 404);
        }

        return $workers;
    }

    public function getClients()
    {
        return User::where("acounttype_id", 2)->get();
    }

    public function getAdmins()
    {
        return User::where("acounttype_id", 1)->get();
    }

    protected function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function updatePassword(Request $request): JsonResponse
    {   
        $user = $this->findUserByEmail($request->email);

        $request->validate([
            'email' => 'required|email',
            'old_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        /*
        *   verificar si el usuario existe
        *   verificar si la contraseña es correcta
        *   verificar si la nueva contraseña es igual a la anterior
        *   actualizar la contraseña
        */

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        }

        if ($request->old_password !== $user->password) {
            return response()->json(['message' => 'Contraseña incorrecta.'], 401);
        }

        if ($request->new_password === $user->password) {
            return response()->json(['message' => 'La nueva contraseña no debe ser igual a la anterior.'], 422);
        }

        try {
            // Crea una nueva instancia de la clase Request con la nueva contraseña
            $req = new Request(['password'=> $request->new_password]);

            // Actualiza la contraseña del usuario
            $user->update($req->all());

            return response()->json(['message' => 'Contraseña actualizada con éxito.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
