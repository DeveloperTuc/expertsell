<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\TmpVenta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberFormatter;
use NumberToWords\NumberToWords;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa_id = Auth::user()->empresa_id;
        $ventas = Venta::with('cliente')->where('empresa_id', $empresa_id)->get();

        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empresa_id = Auth::user()->empresa_id;

        $productos = Producto::where('empresa_id', $empresa_id)->get();
        $clientes = Cliente::where('empresa_id', $empresa_id)->get();

        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha'=>'required',
            //'comprobante'=>'required',
            //'nombre_cliente'=>'required',
            'precio_total'=>'required',
        ]);

        $venta = new Venta(); 
        $venta->fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        //$venta->comprobante = $request->comprobante; 
        $venta->precio_total = floatval(str_replace(['$', ' ', ','], '', $request->precio_total)); 
        $venta->empresa_id = Auth::user()->empresa_id; 
        $venta->cliente_id = $request->id_cliente ?? 12;

        $venta->save();

        $session_id = session()->getId();

        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        foreach($tmp_ventas as $tmp_venta){

            $producto = Producto::where('id', $tmp_venta->producto_id)->first();
            $detalle_venta = new DetalleVenta();

            $detalle_venta->cantidad = $tmp_venta->cantidad;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;
            $detalle_venta->save();

            $producto->stock -= $tmp_venta->cantidad;
            $producto->save();

        }

        TmpVenta::where('session_id', $session_id)->delete();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se registro la venta')
            ->with('icono', 'success');
    }

    public function cliente_store(Request $request){
        
        //datos = request()->all();       
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

        return response()->json([
            'mensaje' => 'Se registró correctamente el cliente',
            'icono' => 'success'
        ], 200);
        
    }

    public function pdf($id){
        //echo $id;

        $venta = Venta::with('detalles', 'cliente')->findOrFail($id);
        $numeroLetras = $this->numeroALetrasConDecimales($venta->precio_total);
        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $id_empresa)->firstOrFail();

        $pdf = PDF::loadView('admin.ventas.pdf', compact('empresa', 'venta', 'numeroLetras'));

        return $pdf->stream();
    }

    public function numeroALetrasConDecimales($numero){
        $formato = new NumberFormatter("es", NumberFormatter::SPELLOUT);

        $partes = explode('.', number_format($numero, 2, '.', ''));

        $entero = $formato->format($partes[0]);

        $decimal = ($partes[1]);

        return ucfirst("$entero con $decimal/100");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //echo($id);
        $venta = Venta::with('detalles','cliente')->findOrFail($id);

        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empresa_id = Auth::user()->empresa_id;
        $venta = Venta::with('detalles', 'cliente')->findOrFail($id);
        $productos = Producto::where('empresa_id', $empresa_id)->get();
        $clientes = Cliente::where('empresa_id', $empresa_id)->get();

        return view('admin.ventas.edit', compact('venta', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($datos);

        $request->validate([
            'fecha'=>'required',
            'precio_total'=>'required',
            'id_cliente' => 'required'
        ]);

        $venta = Venta::find($id); 
        $venta->fecha = Carbon::parse($request->fecha)->format('Y-m-d');
        //$venta->comprobante = $request->comprobante; 
        $venta->precio_total = floatval(str_replace(['$', ' ', ','], '', $request->precio_total)); 
        $venta->empresa_id = Auth::user()->empresa_id; 
        $venta->cliente_id = $request->id_cliente;

        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se actualizo la venta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //echo $id;
        $venta = Venta::findOrFail(  $id);

        foreach ($venta->detalles as $detalle){
            $producto = Producto::findOrFail($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $venta->detalles()->delete();

        Venta::destroy($id);

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'Se elimino la venta')
            ->with('icono', 'success');
    }
}
