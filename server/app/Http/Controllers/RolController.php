<?php

namespace App\Http\Controllers;

use App\Models\rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = rol::all();
        return response()->json($roles);
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
        $rol = new rol();
        $rol->visible = $request->visible;
        $rol->estado = $request->estado;
        $rol->nombre = $request->nombre;
        if ($rol->save()) {
            return response()->json($rol);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = rol::findOrFail($id);
        return response()->json($rol);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo $request;
        $rol = rol::findOrFail($id);
        $rol->visible = $request->visible;
        $rol->estado = $request->estado;
        $rol->nombre = $request->nombre;
        if ($rol->save()) {
            return response()->json($rol);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = rol::findOrFail($id);
        if ($rol->delete())
        {
            return response()->json($rol);
        }
    }
}
