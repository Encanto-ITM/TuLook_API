<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeService;
use Illuminate\Http\Request;
use App\Http\Requests\TypeServiceRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeServiceResource;

class TypeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $typeServices = TypeService::paginate();

        return TypeServiceResource::collection($typeServices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeServiceRequest $request): TypeService
    {
        return TypeService::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeService $typeService): TypeService
    {
        return $typeService;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeServiceRequest $request, TypeService $typeService): TypeService
    {
        $typeService->update($request->validated());

        return $typeService;
    }

    public function destroy(TypeService $typeService): Response
    {
        $typeService->delete();

        return response()->noContent();
    }
}
