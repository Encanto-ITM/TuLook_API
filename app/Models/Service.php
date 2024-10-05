<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 *
 * @property $id
 * @property $name
 * @property $owner_id
 * @property $image
 * @property $price
 * @property $details
 * @property $schedule
 * @property $material_list
 * @property $mode
 * @property $is_active
 * @property $considerations
 * @property $aprox_time
 * @property $type_service_id
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Appointment[] $appointments
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Service extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'owner_id', 'image', 'price', 'details', 'schedule', 'material_list', 'mode', 'is_active', 'considerations', 'aprox_time', 'type_service_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'id', 'service_id');
    }
    
}
