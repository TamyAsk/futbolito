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
                                <th>Escudo</th>
                                <th>Cantidad de titulos</th>
                                {{-- <th>Numero de jugadores</th> --}}
                                <th>Liga</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $equipo)
                            <tr>
                                <td>{{ $equipo->nombre_equipo }}</td>
                                <td><img src="{{ Storage::url($equipo->escudo) }}" alt="" width="100px"></td>
                                <td>{{ $equipo->cant_titulos}}</td>
                                {{-- <td>{{ $equipo->num_jugadores}}</td> --}}
                                <td>{{ $equipo->ligas->nombre }}</td>
                                <td>
                                    <button class="btn btn-edit openModal" 
                                        data-id="{{$equipo->pk_equipos}}" 
                                        data-nombre="{{$equipo->nombre_equipo}}"
                                        data-cant_titulos="{{$equipo->cant_titulos}}"
                                        data-num_jugadores="{{$equipo->num_jugadores}}"
                                        >
                                            Editar
                                        </button>
                                    <button class="btn btn-delete">
                                        <a href="{{ route('eliminar_equipo', $equipo->pk_equipos) }}">Eliminar</a>
                                    </button>   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>   

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p>Editar posición</p>
                            <form id="editForm" action="{{route('actualizar_equipo')}}" method="POST">
                                @csrf
                                <input type="hidden" id="editId" name="id" >
                                <label for="editNombre_equipo">Nombre del equipo:</label>
                                <input type="text" id="editNombre_equipo" name="nombre_equipo" required>

                                <label for="editEscudo">escudo:</label>
                                <input type="file" id="editEscudo" name="escudo">

                                <label for="editCant_titulos">Cantidad de titulos:</label>
                                <input type="number" id="editCant_titulos" name="cant_titulos">

                                {{-- <label for="editNum_jugadores">Numero de jugadores:</label>
                                <input type="number" id="editNum_jugadores" name="num_jugadores"> --}}

                                <label for="">Liga</label>
                                <select name="fk_ligas" id="">
                                    <option value="">Selecciona una opcion</option>
                                    @foreach($ligas as $liga)
                                    <option value="{{$liga->pk_ligas }}">{{ $liga->nombre }}</option>
                                    @endforeach
                                </select>

                                <button class="btn btn-save" type="submit">Guardar cambios</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".btn-delete").forEach(button => {
            button.addEventListener("click", function (event) {
                event.preventDefault(); // Evita que se ejecute el enlace directamente

                let url = this.querySelector("a").href; // Obtiene la URL del enlace de eliminación

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Esta acción no se puede deshacer",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url; // Redirige a la URL de eliminación
                        }
                    });
                });
            });
        });

        $(document).ready(function() {
    $(document).on("click", ".openModal", function() {

        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var cant_titulos = $(this).data("cant_titulos");
        var num_jugadores = $(this).data("num_jugadores");

        $("#editId").val(id);
        $("#editNombre_equipo").val(nombre);
        $("#editCant_titulos").val(cant_titulos);
        // $("#editNum_jugadores").val(num_jugadores);

            // Mostrar el modal
        $("#myModal").css("display", "block");
        });

        // Cerrar el modal al hacer clic en la "x"
        $(".close").click(function() {
            $("#myModal").css("display", "none");
        });

        // Cerrar el modal al hacer clic fuera del contenido
        $(window).click(function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").css("display", "none");
            }
        });

        $("#editForm").on("submit", function(e) {
            e.preventDefault();

             var formulario = new FormData(this);
          
             var url = $(this).attr('action');

             $.ajax({
                 url: url,
                 type: "POST",
                 data: formulario,
                 contentType: false,
                 processData: false,
                 success: function(response) {
                     Swal.fire({
                         icon:'success',
                         title: 'Éxito',
                         text: response.message,
                     }).then(() => {
                         window.location.reload(); 
                     });
                 }
            });
        });

    });

</script>