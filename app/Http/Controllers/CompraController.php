<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\TmpCompra;
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
        $empresa_id = Auth::user()->empresa_id;
        $compras = Compra::with('proveedor')->where('empresa_id', $empresa_id)->get();

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
        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

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
        $compra->empresa_id = Auth::user()->empresa_id; 
        $compra->proveedor_id = $request->id_proveedor;

        $compra->save();

        $session_id = session()->getId();

        $tmp_compras = TmpCompra::where('session_id', $session_id)->get();

        foreach($tmp_compras as $tmp_compra){

            $producto = Producto::where('id', $tmp_compra->producto_id)->first();
            $detalle_compra = new DetalleCompra();

            $detalle_compra->cantidad = $tmp_compra->cantidad;
            $detalle_compra->compra_id = $compra->id;
            $detalle_compra->producto_id = $tmp_compra->producto_id;
            $detalle_compra->save();

            $producto->stock += $tmp_compra->cantidad;
            $producto->save();

        }

        TmpCompra::where('session_id', $session_id)->delete();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se registro la compra')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('detalles','proveedor')->findOrFail($id);

        return view('admin.compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empresa_id = Auth::user()->empresa_id;
        $compra = Compra::with('detalles', 'proveedor')->findOrFail($id);
        $productos = Producto::where('empresa_id', $empresa_id)->get();
        $proveedores = Proveedor::where('empresa_id', $empresa_id)->get();

        return view('admin.compras.edit', compact('compra', 'productos', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'fecha'=>'required',
            'comprobante'=>'required',
            'nombre_proveedor'=>'required',
            'precio_total'=>'required',
            'id_proveedor' => 'required'
        ]);

        $compra = Compra::find($id); 
        $compra->fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        $compra->comprobante = $request->comprobante; 
        $compra->precio_total = floatval(str_replace(['$', ' ', ','], '', $request->precio_total)); 
        $compra->empresa_id = Auth::user()->empresa_id; 
        $compra->proveedor_id = $request->id_proveedor;

        $compra->save();

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se actualizo la compra')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        $compra = Compra::findOrFail(  $id);

        foreach ($compra->detalles as $detalle){
            $producto = Producto::findOrFail($detalle->producto_id);
            $producto->stock -= $detalle->cantidad;
            $producto->save();
        }

        $compra->detalles()->delete();

        Compra::destroy($id);

        return redirect()->route('admin.compras.index')
            ->with('mensaje', 'Se elimino la compra')
            ->with('icono', 'success');

    }
}
