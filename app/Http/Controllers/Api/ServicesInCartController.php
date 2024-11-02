<?php

namespace App\Http\Controllers\Api;

use App\Models\Servicesincart;
use Illuminate\Http\Request;
use App\Http\Requests\ServicesincartRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesincartResource;

class ServicesInCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicesincarts = Servicesincart::all();

        if ($servicesincarts->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $servicesincarts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicesincartRequest $request): Servicesincart
    {
        return Servicesincart::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Servicesincart $servicesincart): Servicesincart
    {
        return $servicesincart;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicesincartRequest $request, Servicesincart $servicesincart): Servicesincart
    {
        $servicesincart->update($request->validated());

        return $servicesincart;
    }

    public function destroy(Servicesincart $servicesincart): Response
    {
        $servicesincart->delete();

        return response()->noContent();
    }

    /**
     * Returns a list of services in cart by user.
     */
    public function getServicesInCartByUser(Request $request)
    {
        $user_id = $request->user;
        $servicesincarts = Servicesincart::where('user_id', $user_id)->get();

        if ($servicesincarts->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $servicesincarts;
    }
}
