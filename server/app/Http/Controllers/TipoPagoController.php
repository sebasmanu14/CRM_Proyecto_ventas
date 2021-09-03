<?php

namespace App\Http\Controllers;

use App\Models\tipo_pago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_pagos = tipo_pago::all();
        return response()->json($tipo_pagos);
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
        $tipo_pago = new tipo_pago();
        $tipo_pago->visible = $request->visible;
        $tipo_pago->estado = $request->estado;
        $tipo_pago->nombre = $request->nombre;
        if ($tipo_pago->save()) {
            return response()->json($tipo_pago);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_pago = tipo_pago::findOrFail($id);
        return response()->json($tipo_pago);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_pago $tipo_pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_pago = tipo_pago::findOrFail($id);
        $tipo_pago->visible = $request->visible;
        $tipo_pago->estado = $request->estado;
        $tipo_pago->nombre = $request->nombre;
        if ($tipo_pago->save()) {
            return response()->json($tipo_pago);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_pago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_pago = tipo_pago::findOrFail($id);
        if ($tipo_pago->delete())
        {
            return response()->json($tipo_pago);
        }
    }
}
