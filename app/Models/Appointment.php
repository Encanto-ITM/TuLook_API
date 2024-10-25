<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Appointment
 *
 * @property $id
 * @property $service_id
 * @property $owner_id
 * @property $applicant
 * @property $date
 * @property $status
 * @property $total
 * @property $location
 * @property $created_at
 * @property $updated_at
 *
 * @property Service $service
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Appointment extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['service_id', 'owner_id', 'applicant', 'date', 'status', 'total', 'location'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id', 'id');
    }
    
   /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function owner()
   {
       return $this->belongsTo(\App\Models\User::class, 'owner_id', 'id');
   }
   
   /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function applicant()
   {
       return $this->belongsTo(\App\Models\User::class, 'applicant', 'id');
   }
    
}
