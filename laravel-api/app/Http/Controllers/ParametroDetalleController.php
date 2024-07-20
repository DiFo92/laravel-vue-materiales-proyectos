<?php

namespace App\Http\Controllers;
use App\Models\ParametroDetalle;
use Illuminate\Support\Facades\DB;

class ParametroDetalleController extends Controller
{
    //
    public function getByParametro(int $id)
    {
        return ParametroDetalle::where('parametro_id', $id)
                        ->get();
    }
    public function getReport()
    {
        $sql = "
        SELECT
            p.nombre as nombreProyecto,
            (SELECT pd.descripcion from parametro_detalles pd where p.departamento_id = pd.id) as departamento,
            (SELECT pd.descripcion from parametro_detalles pd where p.ciudad_id = pd.id) as ciudad,
            m.codigo as codigoMaterial,
            m.descripcion descripcionMaterial,
            m.precio as precioMaterial,
            pm.cantidad as cantidadMaterial,
            pm.cantidad * m.precio as total
        FROM
            proyecto_materials pm
        left join proyectos p on
            pm.proyecto_id = p.id
        left join materials m on
            pm.material_id = m.id
        ";
        $resultado = DB::select($sql);
            return response()->json($resultado, 200);
        return ParametroDetalle::select("SELECT 1");
    }
}
