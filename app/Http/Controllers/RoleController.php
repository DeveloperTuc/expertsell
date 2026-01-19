<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$empresa_id = Auth::user()->empresa_id;

        //$empresa = Empresa::find($empresa_id);

        //return view('admin.roles.index', compact('empresa'));

        $roles = Role::all();

        return view('admin.roles.index', compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:roles',
        ]);

        $rol = new Role();

        $rol->name = $request->name;
        $rol->guard_name = "web";

        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Se registro correctamente el rol')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::find($id);

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $role = Role::find($id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'name'=>'required|unique:roles,name,'.$id,
        ]);

        $rol = Role::find($id);

        $rol->name = $request->name;
        $rol->guard_name = "web";

        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensaje', 'Se modifico correctamente el rol')
        ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //$role = Role::find($id);
        Role::destroy($id);

        return redirect()->route('admin.roles.index')
        ->with('mensaje','Se elimino el rol')
        ->with('icono','success');
    }   
}
