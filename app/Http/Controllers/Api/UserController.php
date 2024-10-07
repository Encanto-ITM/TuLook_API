<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $profilephoto;
    protected $headerphoto;

    public function getProfilePhoto()
    {
        return $this->profilephoto;
    }

    public function setProfilePhoto($profilePhoto)
    {
        $this->profilephoto = $profilePhoto;
    }

    public function getHeaderPhoto()
    {
        return $this->headerphoto;
    }


    public function setHeaderPhoto($headerPhoto)
    {
        $this->headerphoto = $headerPhoto;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): User
    {
        $user = User::create($request->validated());

        // Manejar la subida de imágenes
        if ($request->hasFile('profilephoto')) {
            $user->profilephoto = $this->uploadImage($request->file('profilephoto'), 'profilepics', $user);
        }

        if ($request->hasFile('headerphoto')) {
            $user->headerphoto = $this->uploadImage($request->file('headerphoto'), 'headers', $user);
        }

        $user->save();

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): User
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): User
    {
        $user->update($request->validated());

        // Manejar la subida de imágenes
        if ($request->hasFile('profilephoto')) {
            // Eliminar imagen anterior si existe
            if ($user->getProfilePhoto()) {
                Storage::delete($user->getProfilePhoto());
            }
            $user->setProfilePhoto($this->uploadImage($request->file('profilephoto'), 'profilepics', $user));
        }

        if ($request->hasFile('headerphoto')) {
            // Eliminar imagen anterior si existe
            if ($user->getHeaderPhoto()) {
                Storage::delete($user->getHeaderPhoto());
            }
            $user->setHeaderPhoto($this->uploadImage($request->file('headerphoto'), 'headerpics', $user));
        }

        $user->save();

        return $user;
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }

    /**
     * Upload image
     */
    private function uploadImage($image, $folder, User $user)
    {
        // Generar el nombre del archivo
        $filename = "{$user->id}_{$user->name}_{$user->lastname}." . $image->getClientOriginalExtension();

        // Guardar la imagen en el almacenamiento público
        return Storage::putFileAs("public/{$folder}", $image, $filename);
    }

    public function getWorkers(Request $request)
    {
        return $this->getUsersByAccountType($request, 3, true);
    }

    public function getOnlyUsers(Request $request)
    {
        return $this->getUsersByAccountType($request, 2);
    }

    public function getOnlyAdmins(Request $request)
    {
        return $this->getUsersByAccountType($request, 1, true);
    }

    private function getUsersByAccountType(Request $request, int $accountTypeId, bool $includeProfession = false)
    {
        // Construir la consulta base
        $query = User::select(
            'users.id', // Calificar el id con el nombre de la tabla
            'users.name',
            'users.lastname',
            'users.email',
            'users.contact_public',
            'users.contact_number',
            'users.profilephoto',
            'users.headerphoto'
        );

        // Incluir profesiones si es necesario
        if ($includeProfession) {
            $query->join('professions', 'users.professions_id', '=', 'professions.id')
                ->addSelect('professions.id as profession_id', 'professions.profession');
        }

        // Aplicar filtros
        $workers = $query->where('is_active', 1)
            ->where('acounttype_id', $accountTypeId)
            ->get();

        // Retornar los resultados en formato de recurso
        if ($workers->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }

        return UserResource::collection($workers);
    }
}
