<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posiciones;

class PosicionesController extends Controller
{


    public function create(Request $request)
    {
        $posiciones = new Posiciones();
        $posiciones->nombre = $request->input('nombre');
        $posiciones->save();
    
        return response()->json([
            'success' => true,
            'message' => 'La posición se ha guardado correctamente.'
        ]);
    }
    
    public function show(){
        $posiciones = Posiciones::all();
        return view('formulario_posiciones', compact('posiciones'));
    }

    public function delete($id)
    {
        $posicion = Posiciones::find($id);
        $posicion->delete();

        return redirect('/formulario_posiciones')->with('success', 'La posición ha sido eliminada correctamente.');
    }

    public function actualizar(Request $request)
    {   
        $posicion = Posiciones::find($request->id);
        $posicion->nombre = $request->nombre;
        $posicion->save();
    
        return response()->json(['message' => 'Posición actualizada correctamente.']);
    }

    
}
