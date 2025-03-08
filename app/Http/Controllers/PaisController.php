<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pais;

class PaisController extends Controller
{
    public function create(Request $request)
    {
        $pais = new pais();
        $pais->nombre_pais = $request->input('nombre_pais');
    
        if ($request->hasFile('bandera_pais')) {
            $archivo = $request->file('bandera_pais');
            $rutaArchivo = $archivo->store('banderas', 'public');
            $pais->bandera_pais = $rutaArchivo;
        }
    
        $pais->nacionalidad = $request->input('nacionalidad');
        $pais->save();
    
        return response()->json([
            'success' => true,
            'message' => 'El pais se ah guardado correctamente'
        ]);
    }

    public function show(){
        $paises = pais::all();
        return view('formulario_pais', compact('paises'));
    }

    public function delete($id){
        $pais = pais::find($id);
        $pais->delete();

        return redirect('/formulario_pais')->with('success', 'El pais ha sido eliminado correctamente.');
    }

    public function update(Request $request)
    {
        $pais = Pais::find($request->id);
     
        $pais->nombre_pais = $request->nombre_pais;
        $pais->nacionalidad = $request->nacionalidad;

        if ($request->hasFile('bandera_pais')) {
            $archivo = $request->file('bandera_pais');
            $rutaArchivo = $archivo->store('banderas', 'public');
            $pais->bandera_pais = $rutaArchivo;
        }

        $pais->save();

        return response()->json([
            'success' => true,
            'message' => 'El pais se ah actualizado correctamente'
        ]);
    }
}
