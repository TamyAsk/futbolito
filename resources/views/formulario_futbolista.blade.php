<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulario Futbolistas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="formulario" action="{{route('guardar_futbolista')}}"  enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="">Nombre</label>
                        <input type="text" name="nombre">

                        <label for="">Apellido</label>
                        <input type="text" name="apellido">

                        <label for="">Apodo</label>
                        <input type="text" name="apodo">

                        <label for="">Equipo</label>
                        <select name="fk_equipos" id="">
                            <option value="">Selecciona una opcion</option>
                            @foreach ($equipos as $equipo)
                                <option value="{{$equipo->pk_equipos }}">{{ $equipo->nombre_equipo }}</option>
                            @endforeach
                        </select>

                        <label for="">Pais</label>
                        <select name="fk_pais" id="">
                            <option value="">Selecciona una opcion</option>
                            @foreach ($paises as $pais)
                                <option value="{{$pais->pk_pais }}">{{ $pais->nombre_pais }}</option>
                            @endforeach
                        </select>

                        <label for="">Camiseta</label>
                        <input type="number" name="numero_camiseta">

                        <label for="">Imagen</label>
                        <input type="file" name="foto">

                        <label for="">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento">

                        <label for="">Numero de goles</label>
                        <input type="number" name="goles">

                        <label for="">Numero de asistencias</label>
                        <input type="number" name="asistencias">

                        <label for="">Numero de partidos jugados</label>
                        <input type="number" name="partidos_jugados">

                        <label for="">Numero de titulos</label>
                        <input type="number" name="titulos_individual">

                        <input class="btn btn-save" type="submit" value="Guardar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    $('#formulario').on('submit', function(e) {

    e.preventDefault();
    var formulario = new FormData(this);
    var url = $(this).attr('action');
    formulario.append('escudo', $('#escudo')[0]);

    $.ajax({
            data: formulario,
            url: url,
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message,
                }).then(() => {
                    window.location.reload(); 
                });
            }
        });
    });

</script>