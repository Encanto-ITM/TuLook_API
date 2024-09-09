<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "detail",
        "material_list", //posibles cambios
        "image",
        "aprox_time",
        "considerations",
    ];
}
