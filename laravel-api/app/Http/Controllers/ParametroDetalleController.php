<?php

namespace App\Http\Controllers;
use App\Models\ParametroDetalle;

class ParametroDetalleController extends Controller
{
    //
    public function getByParametro(int $id)
    {
        return ParametroDetalle::where('parametro_id', $id)
                        ->get();
    }
}
