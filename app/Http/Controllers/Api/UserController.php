<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return User::all();
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
    public function update(UserRequest $request, User $user): User
    {
        $user->update($request->validated());

        return $user;
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    public function getWorkers() {
        $workers = User::where("acounttype_id", 3)->get();

        if ($workers->count() == 0) {
            return response()->json([
                "message" => "No workers found",
            ], 404);
        }

        return UserResource::collection($workers); 
    }

    public function getClients() {
        return User::where("acounttype_id", 2)->get();
    }

    public function getAdmins() {
        return User::where("acounttype_id", 1)->get();
    }

    protected function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function updatePassword(Request $request): JsonResponse
    {
        try {
            // Validar la entrada
            $validatedData = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Llamar al método auxiliar para encontrar el usuario
            $user = $this->findUserByEmail($validatedData['email']);

            if ($user) {
                // Actualizar la contraseña (sin encriptar)
                $user->password = $validatedData['password']; // Almacenar directamente
                $user->save(); // Guardar los cambios

                return response()->json(['message' => 'Contrasena actualizada con exito.'], 200);
            }

            return response()->json(['message' => 'Usuario no encontrado.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Hubo un problema: ' . $e->getMessage()], 500);
        }
    }
}
