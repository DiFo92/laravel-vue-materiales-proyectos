<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoMaterial extends Model
{
    use HasFactory;
    protected $fillable = ['material_id', 'proyecto_id', 'cantidad'];
}
