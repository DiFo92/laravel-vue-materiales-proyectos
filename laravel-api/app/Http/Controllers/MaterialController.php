<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\StoreMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Interfaces\MaterialRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\MaterialResource;
use Illuminate\Support\Facades\DB;
class MaterialController extends Controller
{

    private MaterialRepositoryInterface $materialRepositoryInterface;

    public function __construct(MaterialRepositoryInterface $materialRepositoryInterface)
    {
        $this->materialRepositoryInterface = $materialRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->materialRepositoryInterface->index();

        return ApiResponseClass::sendResponse(MaterialResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaterialRequest $request)
    {
        $details =[
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'unidad_id' => $request->unidad_id,
            'precio' => $request->precio
        ];
        DB::beginTransaction();
        try{
             $material = $this->materialRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new MaterialResource($material),'Material Creado Correctamente',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $material = $this->materialRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new MaterialResource($material),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaterialRequest $request, $id)
    {
        $updateDetails =[
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'unidad_id' => $request->unidad_id,
            'precio' => $request->precio
        ];
        DB::beginTransaction();
        try{
             $material = $this->materialRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Material Actualizado Correctamente','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->materialRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Material Eliminado Correctamente','',204);
    }
}
