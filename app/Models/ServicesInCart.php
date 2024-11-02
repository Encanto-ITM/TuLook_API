<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicesincart
 *
 * @property $id
 * @property $service_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicesincart extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['service_id', 'user_id'];


}
