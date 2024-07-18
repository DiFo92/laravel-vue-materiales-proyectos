<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Proyecto::all();
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
            'nombre' => 'required|unique:proyectos|max:255',
            'departamento' => 'required',
            'ciudad' => 'required',
        ]);

        $proyecto = Proyecto::create($validatedData);

        return response()->json($proyecto, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Proyecto::findOrFail($id);

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
        $proyecto = Proyecto::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|max:255|unique:proyectos,nombre,' . $proyecto->id,
            'departamento' => 'required',
            'ciudad' => 'required',
        ]);

        $proyecto->update($validatedData);

        return response()->json($proyecto, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();

        return response()->json(null, 204);
    }
}
