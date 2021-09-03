<?php

namespace App\Http\Controllers;

use App\Models\tipo_producto;
use Illuminate\Http\Request;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_productos = tipo_producto::all();
        return response()->json($tipos_productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo_producto = new tipo_producto();
        $tipo_producto->visible = $request->visible;
        $tipo_producto->estado = $request->estado;
        $tipo_producto->nombre = $request->nombre;
        if ($tipo_producto->save()) {
            return response()->json($tipo_producto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_producto = tipo_producto::findOrFail($id);
        return response()->json($tipo_producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_producto $tipo_producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_producto = tipo_producto::findOrFail($id);
        $tipo_producto->visible = $request->visible;
        $tipo_producto->estado = $request->estado;
        $tipo_producto->nombre = $request->nombre;
        if ($tipo_producto->save()) {
            return response()->json($tipo_producto);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_producto  $tipo_producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_producto = tipo_producto::findOrFail($id);
        if ($tipo_producto->delete())
        {
            return response()->json($tipo_producto);
        }
    }
}
