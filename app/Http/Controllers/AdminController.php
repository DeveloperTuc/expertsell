<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Compra;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $empresa_id = Auth::check() ? Auth::user()->empresa_id : redirect()->route('login')->send();

        $total_roles = Role::count();

        $total_usuarios = User::count();

        $total_categorias = Categoria::count();

        $total_productos = Producto::count();

        $total_proveedores = Proveedor::count();

        $total_compras = Compra::count();

        //$empresa = DB::table('empresas')->where('id', $empresa_id )->get(); utiliza Query Builder
        //$empresa = Empresa::where('id', $empresa_id)->first(); utiliza modelo Eloquent
        $empresa = Empresa::find($empresa_id); //Utiliza modelo Eloquent

        return view('admin.index', compact('empresa', 
                                        'total_roles', 
                                                    'total_usuarios', 
                                                    'total_categorias', 
                                                    'total_productos', 
                                                    'total_proveedores',
                                                    'total_compras'
                                                    ));
    }


}
