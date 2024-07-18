<?php

namespace App\Repositories;
use App\Models\Material;
use App\Interfaces\MaterialRepositoryInterface;
class MaterialRepository implements MaterialRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(){
        return Material::all();
    }

    public function getById($id){
       return Material::findOrFail($id);
    }

    public function store(array $data){
       return Material::create($data);
    }

    public function update(array $data,$id){
       return Material::whereId($id)->update($data);
    }

    public function delete($id){
       Material::destroy($id);
    }
}
