<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulario equipos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="formulario" action="{{route('guardar_equipo')}}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <label for="">Nombre del equipo</label>
                        <input type="text" name="nombre_equipo">

                        <label for="">Imagen del escudo</label>
                        <input type="file" name="escudo">

                        <label for="">Cantidad de titulos</label>
                        <input type="number" name="cant_titulos">

                        {{-- <label for="">Numero de jugadores</label>
                        <input type="number" name="num_jugadores"> --}}

                        <label for="">Liga</label>
                        <select name="fk_ligas" id="">
                            <option value="">Selecciona una opcion</option>
                            @foreach($ligas as $liga)
                            <option value="{{$liga->pk_ligas }}">{{ $liga->nombre}}</option>
                            @endforeach
                        </select>
                        
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