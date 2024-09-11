<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicehasbenefit
 *
 * @property $id
 * @property $service_id
 * @property $benefit_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Benefit $benefit
 * @property Service $service
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Servicehasbenefit extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['service_id', 'benefit_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function benefit()
    {
        return $this->belongsTo(\App\Models\Benefit::class, 'benefit_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id', 'id');
    }
    
}
