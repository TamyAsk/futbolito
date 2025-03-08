<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ligas;
use App\Models\Equipos;


class EquiposController extends Controller
{
    public function show(){
        $ligas = ligas::all();

        return view('formulario_equipo', compact('ligas'));
    }

    public function create(Request $request){
        $equipo = new Equipos();
        $equipo->nombre_equipo = $request->nombre_equipo;
        // Manejar la carga del escudo
        if ($request->hasFile('escudo')) {
            $archivo = $request->file('escudo');
            $rutaArchivo = $archivo->store('escudos', 'public');
            $equipo->escudo = $rutaArchivo;
        }
        $equipo->cant_titulos = $request->cant_titulos;
        // $equipo->num_jugadores = $request->num_jugadores;
        $equipo->fk_ligas = $request->fk_ligas;


        $equipo->save();

        return response()->json([
            'success' => true,
            'message' => 'El equipó se ah guardado correctamente'
        ]);
    }

    public function show_equipos() {
        $equipos = Equipos::all();
        $ligas = ligas::all();

        return view('lista_equipos', compact('equipos', 'ligas'));
    }

    public function delete($id){
        $equipo = Equipos::find($id);
        $equipo->delete();

        return redirect('/lista_equipos')->with('success', 'El equipo ha sido eliminado correctamente.');
    }

    public function update(Request $request){
        $equipo = Equipos::find($request->id);
        $equipo->nombre_equipo = $request->nombre_equipo;

        if ($request->hasFile('escudo')) {
            $archivo = $request->file('escudo');
            $rutaArchivo = $archivo->store('escudos', 'public');
            $equipo->escudo = $rutaArchivo;
        }
        $equipo->cant_titulos = $request->cant_titulos;
        // $equipo->num_jugadores = $request->num_jugadores;

        if($request->filled('fk_ligas')){
            $equipo->fk_ligas = $request->fk_ligas;
        }

        $equipo->save();

        
        return response()->json([
            'success' => true,
            'message' => 'El equipó se ah actualizado correctamente'
        ]);
    }
}
