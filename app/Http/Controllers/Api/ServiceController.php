<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service::select(
            'services.id', // Especifica la tabla para el id
            'services.name',
            'services.price',
            'services.owner_id',
            'user.name as owner_name',
            'user.lastname as owner_lastname',
            'services.image',
            'services.details',
            'services.schedule',
            'services.material_list',
            'services.mode',
            'services.is_active',
            'services.considerations',
            'services.aprox_time',
            'services.type_service_id',
            'type_services.name as type_service_name'
        )
            ->join('type_services', 'services.type_service_id', '=', 'type_services.id')
            ->join('users as user', 'services.owner_id', '=', 'user.id')
            ->get();

        return ServiceResource::collection($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request): Service
    {
        return Service::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service): Service
    {
        return $service;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service): Service
    {
        $service->update($request->validated());

        return $service;
    }

    public function destroy(Service $service): Response
    {
        $service->delete();

        return response()->noContent();
    }

    /**
     * Display a listing of the service for a specified owner.
     */
    public function getServicesByOwner($ownerId)
    {
        // Obtener todos los beneficios relacionados con el servicio
        $services = Service::select(
            'services.id', // Especifica la tabla para el id
            'services.name',
            'services.price',
            'services.owner_id',
            'user.name as owner_name',
            'user.lastname as owner_lastname',
            'services.image',
            'services.details',
            'services.schedule',
            'services.material_list',
            'services.mode',
            'services.is_active',
            'services.considerations',
            'services.aprox_time',
            'services.type_service_id',
            'type_services.name as type_service_name'
        )
            ->join('type_services', 'services.type_service_id', '=', 'type_services.id')
            ->join('users as user', 'services.owner_id', '=', 'user.id')
            ->get();

        // Retornar los beneficios en formato de recurso
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los beneficios en formato de recurso
        return ServiceResource::collection($services);
    }

    /**
     * Display a listing of the services that match the specified name.
     */
    public function getServicesByName(Request $request)
    {
        // Validar el parámetro de búsqueda
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Obtener todos los beneficios que coincidan con el nombre proporcionado
        $services = Service::select(
            'services.id', // Especifica la tabla para el id
            'services.name',
            'services.price',
            'services.owner_id',
            'user.name as owner_name',
            'user.lastname as owner_lastname',
            'services.image',
            'services.details',
            'services.schedule',
            'services.material_list',
            'services.mode',
            'services.is_active',
            'services.considerations',
            'services.aprox_time',
            'services.type_service_id',
            'type_services.name as type_service_name'
        )
            ->join('type_services', 'services.type_service_id', '=', 'type_services.id')
            ->join('users as user', 'services.owner_id', '=', 'user.id')
            ->get();

        // Retornar los beneficios en formato de recurso
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        return ServiceResource::collection($services);
    }


    public function getServicesByType($type_service_id)
    {
        // Obtener todos los beneficios relacionados con el servicio
        $services = Service::where('type_service_id', $type_service_id)->get();

        // Retornar los beneficios en formato de recurso
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        return ServiceResource::collection($services);
    }
}
