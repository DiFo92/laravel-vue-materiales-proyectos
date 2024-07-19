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
       return ProyectoMaterial::create($data);
    }

    public function update(array $data,$id){
       return ProyectoMaterial::whereId($id)->update($data);
    }

    public function delete($id){
       ProyectoMaterial::destroy($id);
    }
}
