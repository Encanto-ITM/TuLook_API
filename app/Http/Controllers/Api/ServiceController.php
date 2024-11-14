<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Service::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request): Service | JsonResponse
    {
        $request->validated();
        
        $data = $request->all();

        if ($request->hasFile('image')) {
            
            $url = $this->uploadImage($request->file('image'), 'services_image');

            // elimina el campo image del request
            unset($data['image']);
            
            // agrega la nueva imagen
            $data['image'] = $url;
        }
        return Service::create($data);
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
        $data = $request->validated();

        $service->fill($data);


        if ($request->hasFile('image')) {
            $service->image = $this->uploadImage($request->file('image'), 'services_image');
        }

        $service->save();

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
        // Fetch services based on owner ID
        $services = $this->fetchServices(function ($query) use ($ownerId) {
            $query->where('services.owner_id', $ownerId);
        });

        return $this->returnServiceResponse($services);
    }

    /**
     * Display a listing of the services that match the specified name.
     */
    public function getServicesByName(Request $request)
    {
        // Validate the search parameter
        if ($request->name === null) {
            return ServiceResource::collection(Service::all());
        }

        // Fetch services based on name
        $services = $this->fetchServices(function ($query) use ($request) {
            $query->where('services.name', 'like', '%' . $request->name . '%');
        });

        return $this->returnServiceResponse($services);
    }

    /**
     * Display a listing of the services that match the specified type service.
     */
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

    private function fetchServices(callable $callback = null)
    {
        $query = Service::select(
            'services.id', // Specify the table for the id
            'services.name',
            'services.owner_id',
            'services.image',
            'services.price',
            'services.details',
            'services.schedule',
            'services.material_list',
            'services.is_active',
            'services.considerations',
            'services.aprox_time',
            'services.type_service_id',
            'user.name as owner_name',
            'user.lastname as owner_lastname',
            'type_services.name as type_service_name'
        )
            ->join('type_services', 'services.type_service_id', '=', 'type_services.id')
            ->join('users as user', 'services.owner_id', '=', 'user.id');

        // Apply additional conditions if provided
        if ($callback) {
            $callback($query);
        }

        return $query->get();
    }

    // Private method to return service response
    private function returnServiceResponse($services)
    {
        if ($services->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        return ServiceResource::collection($services);
    }

    protected function uploadImage($image, $folder)
    {
        if ($image) {
            $uploadedImage = Cloudinary::upload($image->getRealPath(), ['folder' => $folder]);
            $publicId = $uploadedImage->getPublicId();
            return cloudinary()->getUrl($publicId);
        }

        return null;
    }
}
