<?php

namespace App\Http\Controllers;

use App\Models\detalle_venta;
use App\Models\producto;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detalles_ventas = detalle_venta::all();
        return response()->json($detalles_ventas);
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
        $detalle_venta = new detalle_venta();
        $detalle_venta->visible = $request->visible;
        $detalle_venta->estado = $request->estado;
        $detalle_venta->venta_fk = $request->venta_fk;
        $detalle_venta->producto_fk = $request->producto_fk;
        $detalle_venta->cantidad = $request->cantidad;
        if ($detalle_venta->save()) {
            return response()->json($detalle_venta);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detalle_venta  $detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalle_venta = detalle_venta::findOrFail($id);
        return response()->json($detalle_venta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detalle_venta  $detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function edit(detalle_venta $detalle_venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\detalle_venta  $detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detalle_venta = detalle_venta::findOrFail($id);
        $detalle_venta->visible = $request->visible;
        $detalle_venta->estado = $request->estado;
        $detalle_venta->venta_fk = $request->venta_fk;
        $detalle_venta->producto_fk = $request->producto_fk;
        $detalle_venta->cantidad = $request->cantidad;
        if ($detalle_venta->save()) {
            return response()->json($detalle_venta);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detalle_venta  $detalle_venta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle_venta = detalle_venta::findOrFail($id);
        if ($detalle_venta->delete())
        {
            return response()->json($detalle_venta);
        }
    }
    public function verDetalleVentaCliente($id){
        $detalles_venta = detalle_venta::where('venta_fk','=',$id)->get();
        foreach ($detalles_venta as $detalle_venta) {
            $detalle_venta->producto_fk = producto::where('id','=',$detalle_venta->producto_fk)->get()->first();
        }
        return response()->json($detalles_venta);
    }
}
