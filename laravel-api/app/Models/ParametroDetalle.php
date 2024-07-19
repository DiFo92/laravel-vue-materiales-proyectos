<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametroDetalle extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion', 'valor', 'parametro_id'];
}
