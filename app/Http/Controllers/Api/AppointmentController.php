<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $appointments = Appointment::paginate();

        return AppointmentResource::collection($appointments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request): Appointment
    {
        return Appointment::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment): Appointment
    {
        return $appointment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment): Appointment
    {
        $appointment->update($request->validated());

        return $appointment;
    }

    public function destroy(Appointment $appointment): Response
    {
        $appointment->delete();

        return response()->noContent();
    }

    /**
     * Display a listing of the service for a specified owner.
     */
    public function getServicesByOwner($ownerId)
    {
        // Obtener todos los beneficios relacionados con el servicio
        $services = Appointment::where('owner_id', $ownerId)->get();

        // Retornar los beneficios en formato de recurso
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los beneficios en formato de recurso
        return ServiceResource::collection($services);
    }
}
