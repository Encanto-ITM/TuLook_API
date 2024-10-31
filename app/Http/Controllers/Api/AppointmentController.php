<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $appointments = Appointment::select(
            'appointments.*',
            'service.name as service_name',
            DB::raw("CONCAT(user.name, ' ', user.lastname) as owner_fullname"),
            DB::raw("CONCAT(aplicant.name, ' ', aplicant.lastname) as applicant_fullname"),
        )
            ->join('users as user', 'appointments.owner_id', '=', 'user.id')
            ->join('users as aplicant', 'appointments.applicant', '=', 'aplicant.id')
            ->join('services as service', 'appointments.service_id', '=', 'service.id')
            ->get();

        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        return $appointments;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request): Appointment|JsonResponse
    {
        // return response()->json($request->all(), 201);
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
     * Display a listing of the appointments for a specified owner.
     */
    public function getAppointmentsByOwner($ownerId)
    {
        // Obtener todos los servicios relacionados con el servicio
        $appointments = Appointment::select(
            'appointments.*',
            'service.name as service_name',
            DB::raw("CONCAT(user.name, ' ', user.lastname) as owner_fullname"),
            DB::raw("CONCAT(aplicant.name, ' ', aplicant.lastname) as applicant_fullname"),
        )
            ->join('users as user', 'appointments.owner_id', '=', 'user.id')
            ->join('users as aplicant', 'appointments.applicant', '=', 'aplicant.id')
            ->join('services as service', 'appointments.service_id', '=', 'service.id')
            ->where('appointments.owner_id', $ownerId)
            ->get();

        // Retornar los servicios en formato de recurso
        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los servicios en formato de recurso
        return AppointmentResource::collection($appointments);
    }
    /**
     * Display a listing of the appointments for a specified owner  on time.
     */
    public function getAppointmentsByOwneronTime($ownerId)
    {
        // Obtener todos los servicios relacionados con el servicio
        $appointments = Appointment::select(
            'appointments.*',
            'service.name as service_name',
            DB::raw("CONCAT(user.name, ' ', user.lastname) as owner_fullname"),
            DB::raw("CONCAT(aplicant.name, ' ', aplicant.lastname) as applicant_fullname"),
        )
            ->join('users as user', 'appointments.owner_id', '=', 'user.id')
            ->join('users as aplicant', 'appointments.applicant', '=', 'aplicant.id')
            ->join('services as service', 'appointments.service_id', '=', 'service.id')
            ->where('appointments.owner_id', $ownerId)
            ->where('appointments.date', '<=', now())
            ->get();

        // Retornar los servicios en formato de recurso
        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los servicios en formato de recurso
        return AppointmentResource::collection($appointments);
    }

    /**
     * Display a listing of the appointments for a specified owner.
     */
    public function getAppointmentsByUser($user_id)
    {
        // Obtener todos los servicios relacionados con el servicio
        $appointments = Appointment::select(
            'appointments.*',
            'service.name as service_name',
            DB::raw("CONCAT(user.name, ' ', user.lastname) as owner_fullname"),
            DB::raw("CONCAT(aplicant.name, ' ', aplicant.lastname) as applicant_fullname"),
        )
            ->join('users as user', 'appointments.owner_id', '=', 'user.id')
            ->join('users as aplicant', 'appointments.applicant', '=', 'aplicant.id')
            ->join('services as service', 'appointments.service_id', '=', 'service.id')
            ->where('appointments.applicant', $user_id)
            ->get();
        // Retornar los servicios en formato de recurso
        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los servicios en formato de recurso
        return AppointmentResource::collection($appointments);
    }

    /**
     * Display a listing of the appointments for a specified owner and is on time.
     */
    public function getAppointmentsByUserOnTime($user_id)
    {
        // Obtener todos los servicios relacionados con el servicio
        $appointments = Appointment::select(
            'appointments.*',
            'service.name as service_name',
            DB::raw("CONCAT(user.name, ' ', user.lastname) as owner_fullname"),
            DB::raw("CONCAT(aplicant.name, ' ', aplicant.lastname) as applicant_fullname"),
        )
            ->join('users as user', 'appointments.owner_id', '=', 'user.id')
            ->join('users as aplicant', 'appointments.applicant', '=', 'aplicant.id')
            ->join('services as service', 'appointments.service_id', '=', 'service.id')
            ->where('appointments.applicant', $user_id)
            ->where('appointments.date', '<=', now())
            ->get();
        // Retornar los servicios en formato de recurso
        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        // Retornar los servicios en formato de recurso
        return AppointmentResource::collection($appointments);
    }
}
