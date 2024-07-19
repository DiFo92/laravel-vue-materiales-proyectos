<?php

namespace App\Repositories;
use App\Models\Proyecto;
use App\Interfaces\ProyectoRepositoryInterface;
class ProyectoRepository implements ProyectoRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(){
        return Proyecto::all();
    }

    public function getById($id){
       return Proyecto::findOrFail($id);
    }

    public function store(array $data){
       return Proyecto::create($data);
    }

    public function update(array $data,$id){
       return Proyecto::whereId($id)->update($data);
    }

    public function delete($id){
       Proyecto::destroy($id);
    }
}
