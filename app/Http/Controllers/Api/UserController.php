<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

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
    public function store(UserRequest $request): User|JsonResponse
    {
        // return User::create($request->validated());
        return response()->json(['message' => 'Este metodo ya no esta disponible'], 404);
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
        return response()->json([$request->all()], 205);

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
}
