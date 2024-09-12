<?php

namespace App\Http\Controllers\Api;

use App\Models\Servicehasbenefit;
use Illuminate\Http\Request;
use App\Http\Requests\ServicehasbenefitRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicehasbenefitResource;

class ServicehasbenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicehasbenefit = Servicehasbenefit::all();

        return ServicehasbenefitResource::collection($servicehasbenefit);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicehasbenefitRequest $request): Servicehasbenefit
    {
        return Servicehasbenefit::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicehasbenefit $servicehasbenefit): Servicehasbenefit
    {
        return $servicehasbenefit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicehasbenefitRequest $request, Servicehasbenefit $servicehasbenefit): Servicehasbenefit
    {
        $servicehasbenefit->update($request->validated());

        return $servicehasbenefit;
    }

    public function destroy(Servicehasbenefit $servicehasbenefit): Response
    {
        $servicehasbenefit->delete();

        return response()->noContent();
    }
}
