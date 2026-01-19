<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('countries')->get();

        $provincias = DB::table('states')->get();

        $ciudades = DB::table('cities')->get();

        $monedas = DB::table('currencies')->get();

        return  view('admin.empresas.create', compact('paises', 'provincias', 'ciudades', 'monedas'));
    }

    public function buscar_provincia($id_pais){
        try{
            $provincias = DB::table('states')->where('country_id', $id_pais)->get();
            $monedas = DB::table('currencies')->where('country_id', $id_pais)->get();
            $codigos = DB::table('countries')->where('id', $id_pais)->get();
            //return view('admin.empresas.cargar_provincias', compact('provincias', 'monedas', 'codigos'));
            return response()->json([
                'html_provincias' => view('admin.empresas.cargar_provincias', compact('provincias'))->render(),
                'html_monedas' => view('admin.empresas.cargar_monedas', compact('monedas'))->render(),
                'html_codigo' => view('admin.empresas.cargar_codigos', compact('codigos'))->render()
            ]);
        }catch(\Exception $e){
            return response()->json(['mensaje'=>'Error', 'error'=>$e->getMessage()], 500);
        }
    }

    public function buscar_ciudad($id_provincia){
        try{
            $ciudades = DB::table('cities')->where('state_id', $id_provincia)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        }catch(\Exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'pais'=>'required',
            'nombre_empresa'=>'required',
            'tipo_empresa'=>'required',
            'identificacion_tributaria'=>'required|unique:empresas',
            'telefono'=>'required|unique:empresas',
            'correo'=>'required|unique:empresas',
            'nombre_impuesto'=>'required',
            'moneda'=>'required',
            'porcentaje_impuesto'=>'required',
            'direccion'=>'required',
            'ciudad'=>'required',
            'provincia'=>'required',
            'codigo_postal'=>'required',
            'logo'=>'required|image|mimes:png,jpg,jpeg',
        ]);

        $empresa = new Empresa();

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->identificacion_tributaria = $request->identificacion_tributaria;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->porcentaje_impuesto = $request->porcentaje_impuesto;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->provincia = $request->provincia;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public'); //Laravel crea de manera automatica las carpeta "logos"

        $empresa->save();

        $usuario = new User();

        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request->identificacion_tributaria);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();
        $usuario->assignRole("Administrador");

        Auth::login($usuario);

        return redirect()->route('admin.index')
        ->with('mensaje', 'Se registro correctamente la empresa');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //$datos = request()->all();
        //return response()->json($datos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $paises = DB::table('countries')->get();

        $provincias = DB::table('states')->get();

        $ciudades = DB::table('cities')->get();

        $monedas = DB::table('currencies')->get();

        $empresa_id = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $empresa_id)->first();

        $provincias2 = DB::table('states')->where('country_id', $empresa->pais)->get();
        $ciudades2 = DB::table('cities')->where('state_id', $empresa->provincia)->get();
        $monedas2 = DB::table('currencies')->where('country_id', $empresa->pais)->get();
        $codigos = DB::table('countries')->where('id', $empresa->pais)->get();

        return view('admin.configuraciones.edit', compact('paises', 'provincias', 'ciudades', 'monedas', 'empresa', 'provincias2', 'ciudades2', 'monedas2', 'codigos'))->with('authType', 'config');
    }

    public function buscar_por_pais($id_pais){
        try {
            $provincias = DB::table('states')->where('country_id', $id_pais)->get();
            $monedas = DB::table('currencies')->where('country_id', $id_pais)->get();
            $codigos = DB::table('countries')->where('id', $id_pais)->get();

            return response()->json([
                'provincias' => $provincias,
                'monedas' => $monedas,
                'codigos' => $codigos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function buscar_por_provincia($id_provincia){
        try{
            $ciudades = DB::table('cities')->where('state_id', $id_provincia)->get();

            return response()->json([
                'ciudades' => $ciudades
            ]);
        } catch (\Exception $e){
            return response()->json([
                'mensaje' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        try{
            $request->validate([
                'pais'=>'required',
                'nombre_empresa'=>'required',
                'tipo_empresa'=>'required',
                'identificacion_tributaria'=>'required|unique:empresas,identificacion_tributaria,'.$id,
                'telefono'=>'required|unique:empresas,telefono,'.$id,
                'correo'=>'required|unique:empresas,correo,'.$id,
                'nombre_impuesto'=>'required',
                'moneda'=>'required',
                'porcentaje_impuesto'=>'required',
                'direccion'=>'required',
                'ciudad'=>'required',
                'provincia'=>'required',
                'codigo_postal'=>'required',
                //'logo'=>'required|image|mimes:png,jpg,jpeg',
            ]);

            $empresa = Empresa::find($id);

            $empresa->pais = $request->pais;
            $empresa->nombre_empresa = $request->nombre_empresa;
            $empresa->tipo_empresa = $request->tipo_empresa;
            $empresa->identificacion_tributaria = $request->identificacion_tributaria;
            $empresa->telefono = $request->telefono;
            $empresa->correo = $request->correo;
            $empresa->nombre_impuesto = $request->nombre_impuesto;
            $empresa->moneda = $request->moneda;
            $empresa->porcentaje_impuesto = $request->porcentaje_impuesto;
            $empresa->direccion = $request->direccion;
            $empresa->ciudad = $request->ciudad;
            $empresa->provincia = $request->provincia;
            $empresa->codigo_postal = $request->codigo_postal;

            /*if($request->hasFile('logo')){
                Storage::delete('public/'.$empresa->logo);
                $empresa->logo = $request->file('logo')->store('logos', 'public');
            }*/

            if ($request->hasFile('logo')) {
                if ($empresa->logo && Storage::disk('public')->exists($empresa->logo)) {
                    Storage::disk('public')->delete($empresa->logo);
                }
                $empresa->logo = $request->file('logo')->store('logos', 'public');
            }


            $empresa->save();

            $ususario_id = Auth::user()->id;
            $usuario = User::find($ususario_id);

            $usuario->name = "Admin";
            $usuario->email = $request->correo;
            $usuario->password = Hash::make($request->identificacion_tributaria);
            $usuario->empresa_id = $empresa->id;
            $usuario->save();

            //Auth::login($usuario);

            return redirect()->route('admin.index')
            ->with('mensaje', 'Los datos de la empresa se actualizaron correctamente.')
            ->with('icono', 'success');

        } catch (\Exception $e){
            return response()->json([
                'mensaje' => 'Error',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
