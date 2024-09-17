<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\password;

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
 * @property $password
 * @property $remember_token
 * @property $acounttype_id
 * @property $professions_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Acounttype $acounttype
 * @property Profession $profession
 * @property Appointment[] $appointments
 * @property Service[] $services
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'lastname', 'password', 'email', 'contact_number', 'contact_public', 'is_active', 'acounttype_id', 'professions_id'];


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
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'id', 'user_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(\App\Models\Service::class, 'id', 'owner_id');
    }
    
}
