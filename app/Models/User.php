<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use App\Notifications\CustomResetPasswordNotification;

/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $lastname
 * @property $email
 * @property $email_verified_at
 * @property $contact_number
 * @property $contact_public
 * @property $is_active
 * @property $profilephoto
 * @property $headerphoto
 * @property $password
 * @property $address
 * @property $description
 * @property $remember_token
 * @property $acounttype_id
 * @property $professions_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Acounttype $acounttype
 * @property Profession $profession
 * @property Appointment[] $appointments
 * @property Appointment[] $appointments
 * @property Service[] $services
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'socialmedias',
        'contact_number',
        'contact_public',
        'is_active',
        'facebook',
        'instagram',
        'linkedin',
        'x',
        'tiktok',
        'whatsapp',
        'profilephoto',
        'headerphoto',
        'address',
        'description',
        'acounttype_id',
        'professions_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'acounttype_id' => 2,
        'professions_id' => 2,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acounttype()
    {
        return $this->belongsTo(\App\Models\Acounttype::class, 'acounttype_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profession()
    {
        return $this->belongsTo(\App\Models\Profession::class, 'professions_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointmentsOwn()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'id', 'owner_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointmentsApli()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'id', 'applicant');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(\App\Models\Service::class, 'id', 'owner_id');
    }

    public function sendPasswordResetNotification($token)
    {
        // Construye la URL personalizada con el token
        $url = 'https://tulook.vercel.app/updatepassword/' . $token;

        // Envía la notificación usando la URL personalizada
        $this->notify(new CustomResetPasswordNotification($url));
    }
}
