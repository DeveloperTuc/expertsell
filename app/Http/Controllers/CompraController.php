<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\detalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\tmpCompra;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('detalles')->get();

        return view('admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $empresa_id = Auth::user()->empresa_id;

        $productos = Producto::where('empresa_id', $empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', $empresa_id)->get();

        $session_id = session()->getId();
        $tmp_compras = tmpCompra::where('session_id', $session_id)->get();

        return view('admin.compras.create', compact('productos', 'proveedores', 'tmp_compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'fecha'=>'required',
            'comprobante'=>'required',
            'nombre_proveedor'=>'required',
            'precio_total'=>'required',
        ]);

        $compra = new Compra(); 
        $compra->fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        $compra->comprobante = $request->comprobante; 
        $compra->precio_total = floatval(str_replace(['$', ' ', ','], '', $request->precio_total)); 
        $compra->empresa_id = Auth::user()->empresa_id; $compra->save();

        $session_id = session()->getId();

        $tmp_compras = tmpCompra::where('session_id', $session_id)->get();

        foreach($tmp_compras as $tmp_compra){

            $producto = Producto::where('id', $tmp_compra->producto_id)->first();
            $detalle_compra = new detalleCompra();

            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->precio_producto = $producto->precio_compra;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;
            $detalle_compra->proveedor_id = $request->id_proveedor;
            $detalle_compra->save();

            $producto->stock += $tmp_compra->cantidad;
            $producto->save();

        }

        tmpCompra::where('session_id', $session_id)->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se registro la compra')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('detalles','productos')->findOrFail($id);

        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::with('detalles', 'proveedores')->findOrFail($id);
        $productos = Producto::all();
        $proveedores = Proveedor::all();

        return view('admin.compras.edit', compact('compra', 'productos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
