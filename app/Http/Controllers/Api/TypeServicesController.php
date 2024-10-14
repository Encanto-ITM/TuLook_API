<?php

namespace App\Http\Controllers\Api;

use App\Models\TypeServices;
use Illuminate\Http\Request;
use App\Http\Requests\TypeServicesRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeServicesResource;

class TypeServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $typeServices = TypeServices::all();

        if ($typeServices->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }
            
        
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
    public function show(TypeServices $typeServices): TypeServices
    {
        return $typeServices;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeServicesRequest $request, TypeServices $typeServices): TypeServices
    {
        $typeServices->update($request->validated());

        return $typeServices;
    }

    public function destroy(TypeServices $typeServices): Response
    {
        $typeServices->delete();

        return response()->noContent();
    }
}
