<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa_id = Auth::user()->empresa_id;
        $clientes = Cliente::where('empresa_id', $empresa_id)->get();

        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();       
        //return response()->json($datos);

        $request->validate([
            'nombre_cliente'=>'required',
            'identificacion_tributaria'=>'required|unique:clientes',
            'telefono'=>'required|unique:clientes',
            'email'=>'required|unique:clientes'
        ]);

        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->identificacion_tributaria = $request->identificacion_tributaria;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;


        $cliente->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'Se registro correctamente el cliente')
        ->with('icono','success');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();       
        //return response()->json($datos);
        
        $request->validate([
            'nombre_cliente'=>'required',
            'identificacion_tributaria'=>'required|unique:clientes,identificacion_tributaria,'.$id,
            'telefono'=>'required|unique:clientes,telefono,'.$id,
            'email'=>'required|unique:clientes,email,'.$id
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->identificacion_tributaria = $request->identificacion_tributaria;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;


        $cliente->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'Se actualizo el cliente')
        ->with('icono','success');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo($id);

        Cliente::destroy($id);

        return redirect()->route('admin.clientes.index')
        ->with('mensaje','Se elimino correctamente al cliente.')
        ->with('icono','success');
    }
}
