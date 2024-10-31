<?php

namespace App\Http\Controllers\Api;

use App\Models\ServicesInCart;
use Illuminate\Http\Request;
use App\Http\Requests\ServicesInCartRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServicesInCartResource;

class ServicesInCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $servicesInCarts = ServicesInCart::all();

        if ($servicesInCarts->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $servicesInCarts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicesInCartRequest $request): ServicesInCart
    {
        return ServicesInCart::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicesInCart $servicesInCart): ServicesInCart
    {
        return $servicesInCart;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicesInCartRequest $request, ServicesInCart $servicesInCart): ServicesInCart
    {
        $servicesInCart->update($request->validated());

        return $servicesInCart;
    }

    public function destroy(ServicesInCart $servicesInCart): Response
    {
        $servicesInCart->delete();

        return response()->noContent();
    }

    public function getByUser(Request $request)
    {
        $user = $request->user;
        $servicesInCarts = ServicesInCart::where("user_id", $user->id)->get();

        if ($servicesInCarts->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return $servicesInCarts;
    }
}
