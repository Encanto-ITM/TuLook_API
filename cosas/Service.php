<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "owner_id",
        "details",
        "location",
        "schedule",
        "start_at",
        "end_at",
    ] ;
}
