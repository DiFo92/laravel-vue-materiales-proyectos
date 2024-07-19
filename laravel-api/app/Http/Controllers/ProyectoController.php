<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Interfaces\ProyectoRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\ProyectoResource;
use Illuminate\Support\Facades\DB;
class ProyectoController extends Controller
{

    private ProyectoRepositoryInterface $proyectoRepositoryInterface;

    public function __construct(ProyectoRepositoryInterface $proyectoRepositoryInterface)
    {
        $this->proyectoRepositoryInterface = $proyectoRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->proyectoRepositoryInterface->index();

        return ApiResponseClass::sendResponse(ProyectoResource::collection($data),'',200);
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
    public function store(StoreProyectoRequest $request)
    {
        $details =[
            'nombre' => $request->nombre,
            'departamento_id' => $request->departamento_id,
            'ciudad_id' => $request->ciudad_id,
        ];
        DB::beginTransaction();
        try{
             $proyecto = $this->proyectoRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new ProyectoResource($proyecto),'Proyecto Creado Correctamente',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyecto = $this->proyectoRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new ProyectoResource($proyecto),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, $id)
    {
        $updateDetails =[
            'nombre' => $request->nombre,
            'departamento_id' => $request->departamento_id,
            'ciudad_id' => $request->ciudad_id,
        ];
        DB::beginTransaction();
        try{
             $proyecto = $this->proyectoRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Proyecto Actualizado Correctamente','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->proyectoRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Proyecto Eliminado Correctamente','',204);
    }
}
