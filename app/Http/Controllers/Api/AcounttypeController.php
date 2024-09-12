<?php

namespace App\Http\Controllers\Api;

use App\Models\Acounttype;
use Illuminate\Http\Request;
use App\Http\Requests\AcounttypeRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcounttypeResource;

class AcounttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $acounttypes = Acounttype::all();

        return AcounttypeResource::collection($acounttypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcounttypeRequest $request): Acounttype
    {
        return Acounttype::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Acounttype $acounttype): Acounttype
    {
        return $acounttype;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcounttypeRequest $request, Acounttype $acounttype): Acounttype
    {
        $acounttype->update($request->validated());

        return $acounttype;
    }

    public function destroy(Acounttype $acounttype): Response
    {
        $acounttype->delete();

        return response()->noContent();
    }
}
