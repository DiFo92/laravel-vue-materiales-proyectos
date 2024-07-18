<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Material::all();
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
            'codigo' => 'required|unique:materials|max:255',
            'descripcion' => 'required',
            'unidad' => 'required',
            'precio' => 'required|numeric',
        ]);

        $material = Material::create($validatedData);

        return response()->json($material, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Material::findOrFail($id);
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
        $material = Material::findOrFail($id);

        $validatedData = $request->validate([
            'codigo' => 'required|max:255|unique:materials,codigo,' . $material->id,
            'descripcion' => 'required',
            'unidad' => 'required',
            'precio' => 'required|numeric',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json(null, 204);
    }
}
