<?php

namespace App\Http\Controllers;

use App\Models\ProyectoMaterial;
use App\Http\Requests\StoreProyectoMaterialRequest;
use App\Http\Requests\UpdateProyectoMaterialRequest;
use App\Interfaces\ProyectoMaterialRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\ProyectoMaterialResource;
use Illuminate\Support\Facades\DB;
class ProyectoMaterialController extends Controller
{

    private ProyectoMaterialRepositoryInterface $proyectoMaterialRepositoryInterface;

    public function __construct(ProyectoMaterialRepositoryInterface $proyectoMaterialRepositoryInterface)
    {
        $this->proyectoMaterialRepositoryInterface = $proyectoMaterialRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->proyectoMaterialRepositoryInterface->index();

        return ApiResponseClass::sendResponse(ProyectoMaterialResource::collection($data),'',200);
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
    public function store(StoreProyectoMaterialRequest $request)
    {
        $details =[
            'material_id' => $request->material_id,
            'proyecto_id' => $request->proyecto_id,
            'cantidad' => $request->cantidad,
        ];
        DB::beginTransaction();
        try{
             $proyectoMaterial = $this->proyectoMaterialRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new ProyectoMaterialResource($proyectoMaterial),'ProyectoMaterial Creado Correctamente',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyectoMaterial = $this->proyectoMaterialRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new ProyectoMaterialResource($proyectoMaterial),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProyectoMaterial $proyectoMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoMaterialRequest $request, $id)
    {
        $updateDetails =[
            'material_id' => $request->material_id,
            'proyecto_id' => $request->proyecto_id,
            'cantidad' => $request->cantidad,
        ];
        DB::beginTransaction();
        try{
             $proyectoMaterial = $this->proyectoMaterialRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('ProyectoMaterial Actualizado Correctamente','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->proyectoMaterialRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('ProyectoMaterial Eliminado Correctamente','',204);
    }
}
