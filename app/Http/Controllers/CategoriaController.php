<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();

        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();       
        //return response()->json($datos);

        $request->validate([
            'nombre'=>'required|unique:categorias',
            'descripcion'=>'required',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;

        $categoria->save();

        return redirect()->route('admin.categorias.index')
        ->with('mensaje', 'Se registro correctamente la categoría')
        ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //echo $id;
        $categoria = Categoria::find($id);

        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //echo $id;
        $categoria = Categoria::find( $id );

        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();       
        //return response()->json($datos);

        $request->validate([
            'nombre'=>'required|unique:categorias,nombre,'.$id,
            'descripcion'=>'required',
        ]);

        $categoria = Categoria::find($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->empresa_id = Auth::user()->empresa_id;
        
        $categoria->save();

        return redirect()->route('admin.categorias.index')
        ->with('mensaje','Se actualizaron correctamente los datos')
        ->with('icono','success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Categoria::destroy($id);

        return redirect()->route('admin.categorias.index')
        ->with('mensaje','Se elimino correctamente la categoría.')
        ->with('icono','success');
    }
}
