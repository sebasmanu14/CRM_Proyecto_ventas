<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\cuenta_bancaria;
use Illuminate\Http\Request;
use App\Mail\messageCreatUser;
use Illuminate\Support\Facades\Mail;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = cliente::all();
        return response()->json($clientes);
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
        $user_exist = cliente::where('correo','=', $request->correo)
            ->orWhere('numero_identificacion',$request->numero_identificacion)
            ->select('nombres')
            ->get()
            ->first();
        if ($user_exist) {
            return response()->json($user_exist);
        } else {
            $cliente = new cliente();
            $cliente->visible = $request->visible;
            $cliente->estado = $request->estado;
            $cliente->rol_fk = $request->rol_fk;
            $cliente->cuenta_bancaria_fk = $request->cuenta_bancaria_fk;
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->correo = $request->correo;
            $cliente->clave = $request->clave;
            $cliente->numero_identificacion = $request->numero_identificacion;
            $cliente->numero_telefono = $request->numero_telefono;
            $cliente->direccion = $request->direccion;
            if ($cliente->save()) {
                // Mail::to($cliente->correo)->send(new messageCreatUser);
                return response()->json(['id' => $cliente->id]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = cliente::where('id','=',$id)->select(
            'id',
            'rol_fk',
            'cuenta_bancaria_fk',
            'nombres',
            'apellidos',
            'correo',
            'numero_identificacion',
            'numero_telefono',
            'direccion'
        )
        ->get()
        ->first();
        $cliente->cuenta_bancaria_fk = cuenta_bancaria::where('id','=',$cliente->cuenta_bancaria_fk)
        ->get()
        ->first();
        return response()->json($cliente);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->visible) {
            $cliente = cliente::findOrFail($id);
            $cliente->cuenta_bancaria_fk = $request->cuenta_bancaria_fk;
            if ($cliente->save()) {
                return response()->json($cliente);
            }
        }
        $cliente = cliente::findOrFail($id);
        $cliente->visible = $request->visible;
        $cliente->estado = $request->estado;
        $cliente->rol_fk = $request->rol_fk;
        $cliente->cuenta_bancaria_fk = $request->cuenta_bancaria_fk;
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->correo = $request->correo;
        $cliente->clave = $request->clave;
        $cliente->numero_identificacion = $request->numero_identificacion;
        $cliente->numero_telefono = $request->numero_telefono;
        $cliente->direccion = $request->direccion;
        if ($cliente->save()) {
            return response()->json($cliente);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = cliente::findOrFail($id);
        if ($cliente->delete())
        {
            return response()->json($cliente);
        }
    }
    public function login(Request $request) {
        $user = cliente::where('correo','=',$request->correo)->get()->first();
        if ($user) {
            if ($user != null && $user->clave == $request->pass) {
                return response()->json(cliente::where('correo','=',$request->correo)
                    ->select(
                        'id',
                        'rol_fk',
                        'nombres',
                        'apellidos'
                    )
                    ->get()
                    ->first());
            } else {
                return response()->json(['message_2'=>'Credenciales incorrectas']);
            }
        } else {
            return response()->json(['message_1'=>'Usuario no encontrado']);
        }
    }
}
