<?php

namespace App\Repositories;
use App\Models\ProyectoMaterial;
use App\Interfaces\ProyectoMaterialRepositoryInterface;
class ProyectoMaterialRepository implements ProyectoMaterialRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(){
        return ProyectoMaterial::all();
    }

    public function getById($id){
       return ProyectoMaterial::findOrFail($id);
    }

    public function store(array $data){
        // Verificar unicidad
        $exists = ProyectoMaterial::where('material_id', $data['material_id'])
                          ->where('proyecto_id', $data['proyecto_id'])
                          ->exists();

        if ($exists) {
            return response()->json(['error' => 'El material con este código y descripción ya existe.'], 422);
        }
        return ProyectoMaterial::create($data);
    }

    public function update(array $data,$id){
       return ProyectoMaterial::whereId($id)->update($data);
    }

    public function delete($id){
       ProyectoMaterial::destroy($id);
    }
}
