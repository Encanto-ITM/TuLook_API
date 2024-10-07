<?php

namespace App\Http\Controllers\Api;

use App\Models\Profession;
use Illuminate\Http\Request;
use App\Http\Requests\ProfessionRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfessionResource;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $professions = Profession::all();

        return ProfessionResource::collection($professions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfessionRequest $request): Profession
    {
        return Profession::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession): Profession
    {
        return $profession;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfessionRequest $request, Profession $profession): Profession
    {
        $profession->update($request->validated());

        return $profession;
    }

    public function destroy(Profession $profession): Response
    {
        $profession->delete();

        return response()->noContent();
    }
}
