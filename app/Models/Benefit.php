<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Benefit
 *
 * @property $id
 * @property $name
 * @property $detail
 * @property $material_list
 * @property $image
 * @property $aprox_time
 * @property $considerations
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Benefit extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'detail', 'material_list', 'image', 'aprox_time', 'considerations'];


}
