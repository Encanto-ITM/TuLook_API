<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeServices;
use Illuminate\Http\Request;
use App\Http\Requests\TypeServicesRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeServicesResource;

class TypeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return TypeServices::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeServicesRequest $request): TypeServices
    {
        return TypeServices::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeServices $typeService): TypeServices
    {
        return $typeService;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeServicesRequest $request, TypeServices $typeService): TypeServices
    {
        $typeService->update($request->validated());

        return $typeService;
    }

    public function destroy(TypeServices $typeService): Response
    {
        $typeService->delete();

        return response()->noContent();
    }
}
