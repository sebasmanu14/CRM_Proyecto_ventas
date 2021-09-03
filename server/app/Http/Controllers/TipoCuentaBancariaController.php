<?php

namespace App\Http\Controllers;

use App\Models\tipo_cuenta_bancaria;
use Illuminate\Http\Request;

class TipoCuentaBancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos_cuentas_bancarias = tipo_cuenta_bancaria::all();
        return response()->json($tipos_cuentas_bancarias);
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
        $tipo_cuenta_bancaria = new tipo_cuenta_bancaria();
        $tipo_cuenta_bancaria->visible = $request->visible;
        $tipo_cuenta_bancaria->estado = $request->estado;
        $tipo_cuenta_bancaria->nombre = $request->nombre;
        if ($tipo_cuenta_bancaria->save()) {
            return response()->json($tipo_cuenta_bancaria);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tipo_cuenta_bancaria  $tipo_cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_cuenta_bancaria = tipo_cuenta_bancaria::findOrFail($id);
        return response()->json($tipo_cuenta_bancaria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tipo_cuenta_bancaria  $tipo_cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_cuenta_bancaria $tipo_cuenta_bancaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tipo_cuenta_bancaria  $tipo_cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo_cuenta_bancaria = tipo_cuenta_bancaria::findOrFail($id);
        $tipo_cuenta_bancaria->visible = $request->visible;
        $tipo_cuenta_bancaria->estado = $request->estado;
        $tipo_cuenta_bancaria->nombre = $request->nombre;
        if ($tipo_cuenta_bancaria->save()) {
            return response()->json($tipo_cuenta_bancaria);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tipo_cuenta_bancaria  $tipo_cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo_cuenta_bancaria = tipo_cuenta_bancaria::findOrFail($id);
        if ($tipo_cuenta_bancaria->delete())
        {
            return response()->json($tipo_cuenta_bancaria);
        }
    }
}
