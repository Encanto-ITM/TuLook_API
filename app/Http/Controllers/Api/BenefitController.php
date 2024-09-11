<?php

namespace App\Http\Controllers\Api;

use App\Models\Benefit;
use Illuminate\Http\Request;
use App\Http\Requests\BenefitRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitResource;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $benefits = Benefit::paginate();

        return BenefitResource::collection($benefits);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BenefitRequest $request): Benefit
    {
        return Benefit::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Benefit $benefit): Benefit
    {
        return $benefit;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BenefitRequest $request, Benefit $benefit): Benefit
    {
        $benefit->update($request->validated());

        return $benefit;
    }

    public function destroy(Benefit $benefit): Response
    {
        $benefit->delete();

        return response()->noContent();
    }
}
