<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profession
 *
 * @property $id
 * @property $profession
 * @property $detail
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Profession extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['profession', 'detail'];


}
