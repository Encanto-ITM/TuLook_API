<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

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

    // public function getWorkers() {
    //     $workers = User::where("acounttype_id", 3)->get();

    //     if ($workers->count() == 0) {
    //         return response()->json([
    //             "message" => "No workers found",
    //         ], 404);
    //     }

    //     return UserResource::collection($workers); 
    // }

    // public function getClients() {
    //     return User::where("acounttype_id", 2)->get();
    // }

    // public function getAdmins() {
    //     return User::where("acounttype_id", 1)->get();
    // }
}
