<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Models\Equipos;
use App\Models\Futbolistas;

class FutbolistasController extends Controller
{
    public function show(){
        $paises = Pais::all();
        $equipos = Equipos::all();
        
        return view('formulario_futbolista', compact('paises', 'equipos'));
    }

    public function create(Request $request)
    {
        $futbolista = new Futbolistas();
        $futbolista->nombre = $request->nombre;
        $futbolista->apellido = $request->apellido;
        $futbolista->apodo = $request->apodo;
        $futbolista->fk_equipos = $request->fk_equipos;
        $futbolista->fk_pais = $request->fk_pais;
        $futbolista->numero_camiseta = $request->numero_camiseta;
        $futbolista->fecha_nacimiento = $request->fecha_nacimiento;

        if ($request->hasFile('foto')) {
            $archivo = $request->file('foto');
            $rutaArchivo = $archivo->store('fotos', 'public');
            $futbolista->foto = $rutaArchivo;
        }
        $futbolista->asistencias = $request->asistencias;
        $futbolista->goles = $request->goles;

        $futbolista->partidos_jugados = $request->partidos_jugados;
        $futbolista->titulos_individual = $request->titulos_individual;

        $futbolista->save();
           
        return response()->json([
            'success' => true,
            'message' => 'El futbolista se ah guardado correctamente'
        ]);
    }

    public function show_futbolistas(Request $request){
        $futbolistas = Futbolistas::all();

        return view('lista_futbolistas', compact('futbolistas'));
    }
}
