<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Apodo</th>
                                <th>Equipo</th>
                                <th>Pais</th>
                                <th>Camiseta</th>
                                <th>Fecha de nacimiento</th>
                                <th>Foto</th>
                                <th>Asistencia</th>
                                <th>Goles</th>
                                <th>Partidos</th>
                                <th>Titulos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($futbolistas as $futbolista)

                            <tr>
                                <td>{{ $futbolista->nombre }}</td>
                                <td>{{ $futbolista->apellido }}</td>
                                <td>{{ $futbolista->apodo }}</td>
                                <td>{{ $futbolista->fk_equipo }}</td>
                                <td>{{ $futbolista->fk_pais }}</td>
                                <td>{{ $futbolista->numero_camiseta }}</td>
                                <td>{{ $futbolista->fecha_nacimiento}}</td>
                                <td><img src="{{ Storage::url($futbolista->foto) }}" alt="" width="100px"></td>
                                <td>{{ $futbolista->asistencias }}</td>
                                <td>{{ $futbolista->goles }}</td>
                                <td>{{ $futbolista->partidos_jugados }}</td>
                                <td>{{ $futbolista->titulos_individual }}</td>
                                <td>
                                    <button class="btn btn-edit openModal" 
                                        data-id="{{$futbolista->pk_futbolistas}}" 
                                        data-nombre="{{$futbolista->nombre_futbolista}}"
                                        data-cant_titulos="{{$futbolista->cant_titulos}}"
                                        data-num_jugadores="{{$futbolista->num_jugadores}}"
                                        >
                                            Editar
                                    </button>
                                    <button class="btn btn-delete">
                                        <a href="">Eliminar</a>
                                    </button>   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
