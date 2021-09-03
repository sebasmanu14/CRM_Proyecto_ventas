<?php

namespace App\Http\Controllers;

use App\Models\venta;
use App\Models\cliente;
use App\Models\tipo_pago;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = venta::where('visible','=','1')->orderByDesc('id')->get();

        foreach ($ventas as $venta) {
            $venta->cliente_fk = cliente::findOrFail($venta->cliente_fk);
            $venta->tipo_pago_fk = tipo_pago::findOrFail($venta->tipo_pago_fk);
        }
        return response()->json($ventas);
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
        $venta = new venta();
        $venta->visible = $request->visible;
        $venta->estado = $request->estado;
        $venta->cliente_fk = $request->cliente_fk;
        $venta->tipo_pago_fk = $request->tipo_pago_fk;
        $venta->total = $request->total;
        $venta->iva = $request->iva;
        $venta->descuento = $request->descuento;
        if ($venta->save()) {
            return response()->json($venta->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = venta::findOrFail($id);
        return response()->json($venta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venta = venta::findOrFail($id);
        $venta->visible = $request->visible;
        $venta->estado = $request->estado;
        $venta->cliente_fk = $request->cliente_fk;
        $venta->tipo_pago_fk = $request->tipo_pago_fk;
        $venta->total = $request->total;
        $venta->iva = $request->iva;
        $venta->descuento = $request->descuento;
        if ($venta->save()) {
            return response()->json($venta);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venta = venta::findOrFail($id);
        if ($venta->delete())
        {
            return response()->json($venta);
        }
    }
}
