<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carts = Cart::all();

        if ($carts->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return CartResource::collection($carts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request): Cart
    {
        return Cart::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart): Cart
    {
        return $cart;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartRequest $request, Cart $cart): Cart
    {
        $cart->update($request->validated());

        return $cart;
    }

    public function destroy(Cart $cart): Response
    {
        $cart->delete();

        return response()->noContent();
    }

    /**
     * Get all carts by user
     */
    public function getByUser(Request $request)
    {
        if (User::find($request->user_id)) {
            $user = Cart::where("user_id", $request->user_id)->get();
        } else{
            return response()->json([
                "message" => "El usuario no existe",
            ], 404);
        }

        if ($user->count() == 0) {
            return response()->json([
                "message" => "No se encontraron resultados",
            ], 404);
        }

        return response()->json($user);
    }
}
