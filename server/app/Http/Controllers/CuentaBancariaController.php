<?php

namespace App\Http\Controllers;

use App\Models\cuenta_bancaria;
use App\Models\tipo_cuenta_bancaria;
use Illuminate\Http\Request;

class CuentaBancariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas_bancarias = cuenta_bancaria::all();
        return response()->json($cuentas_bancarias);
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
        $cuenta_existente = cuenta_bancaria::where(
            'numero_cuenta','=',$request->numero_cuenta)
            ->get()
            ->first();
        if ($cuenta_existente) {
            return response()->json(['message' => 'cuenta bancaria existente']);
        } else {
            $tipo_enviado = tipo_cuenta_bancaria::where('nombre','=',$request->tipo_cuenta_bancaria_fk)
                ->select('id')
                ->get()
                ->first();
            if ($tipo_enviado) {
                $cuenta_bancaria = new cuenta_bancaria();
                $cuenta_bancaria->visible = $request->visible;
                $cuenta_bancaria->estado = $request->estado;
                $cuenta_bancaria->tipo_cuenta_bancaria_fk = $tipo_enviado->id;
                $cuenta_bancaria->numero_cuenta = $request->numero_cuenta;
                $cuenta_bancaria->nombre_banco = $request->nombre_banco;
                if ($cuenta_bancaria->save()) {
                    return response()->json($cuenta_bancaria['id']);
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cuenta_bancaria  $cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuenta_bancaria = cuenta_bancaria::findOrFail($id);
        return response()->json($cuenta_bancaria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cuenta_bancaria  $cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function edit(cuenta_bancaria $cuenta_bancaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cuenta_bancaria  $cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cuenta_bancaria = cuenta_bancaria::findOrFail($id);
        $cuenta_bancaria->visible = $request->visible;
        $cuenta_bancaria->estado = $request->estado;
        $cuenta_bancaria->tipo_cuenta_bancaria_fk = $request->tipo_cuenta_bancaria_fk;
        $cuenta_bancaria->numero_cuenta = $request->numero_cuenta;
        $cuenta_bancaria->nombre_banco = $request->nombre_banco;
        if ($cuenta_bancaria->save()) {
            return response()->json($cuenta_bancaria);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cuenta_bancaria  $cuenta_bancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuenta_bancaria = cuenta_bancaria::findOrFail($id);
        if ($cuenta_bancaria->delete())
        {
            return response()->json($cuenta_bancaria);
        }
    }
}
