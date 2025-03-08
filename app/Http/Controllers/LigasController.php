<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pais;
use App\Models\ligas;

class LigasController extends Controller
{
    public function show(){
        $pais = pais::all();
        $ligas = ligas::all();
        
        return view('formulario_ligas', compact('pais', 'ligas'));
    }

    public function create(Request $request){   
        $liga = new ligas();
        $liga->nombre = $request->nombre;
        $liga->fk_pais = $request->fk_pais;

        // Manejar la carga del logo
        if ($request->hasFile('logo_ligas')) {
            $archivo = $request->file('logo_ligas');
            $rutaArchivo = $archivo->store('logos_ligas', 'public');
            $liga->logo_ligas =$rutaArchivo;
        }

        $liga->save();

        return response()->json([
            'success' => true,
            'message' => 'La liga se ah guardado correctamente'
        ]);
    }

    public function delete($id){
        $liga = ligas::find($id);
        $liga->delete();

        return redirect('/formulario_ligas')->with('success', 'La liga ha sido eliminada correctamente.');
    }

    public function update(Request $request){
        $liga = ligas::find($request->id);
        $liga->nombre = $request->nombre;

        if($request->filled('fk_pais')){
            $liga->fk_pais = $request->fk_pais;
        }

        if ($request->hasFile('logo_ligas')) {
            $archivo = $request->file('logo_ligas');
            $rutaArchivo = $archivo->store('logos_ligas', 'public');
            $liga->logo_ligas =$rutaArchivo;
        }

        $liga->save();

        return response()->json([
           'success' => true,
           'message' => 'La liga se ah actualizado correctamente'
        ]);
    }

}
