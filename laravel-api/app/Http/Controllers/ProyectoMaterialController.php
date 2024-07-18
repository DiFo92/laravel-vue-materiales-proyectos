<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoMaterial;

class ProyectoMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ProyectoMaterial::all();
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
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'cantidad' => 'required|numeric',
        ]);

        $proyecto_material = ProyectoMaterial::create($validatedData);

        return response()->json($proyecto_material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return ProyectoMaterial::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $proyecto_material = ProyectoMaterial::findOrFail($id);

        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'cantidad' => 'required|numeric',
        ]);

        $proyecto_material->update($validatedData);

        return response()->json($proyecto_material, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $proyecto_material = ProyectoMaterial::findOrFail($id);
        $proyecto_material->delete();

        return response()->json(null, 204);
    }
}
