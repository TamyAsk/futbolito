<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paises') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="formulario" action="{{route('guardar_pais')}}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <label for="">Nombre del pais</label>
                        <input type="text" name="nombre_pais">

                        <label for="">Imagen de la bandera</label>
                        <input type="file" name="bandera_pais">

                        <label for="">Nacionalidad</label>
                        <input type="text" name="nacionalidad">
                        
                        <input class="btn btn-save" type="submit" value="Guardar">

                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>Pais</th>
                                <th>Imagen</th>
                                <th>Nacionalidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paises as $pais)
                                <tr>
                                    <td>{{ $pais->nombre_pais}}</td>
                                    <td><img src="{{ Storage::url($pais->bandera_pais) }}" alt="{{ $pais->nombre_pais}}" width="100px"></td>
                                    <td>{{ $pais->nacionalidad}}</td>
                                    <td>
                                        <button class="btn btn-edit openModal" 
                                        data-id="{{ $pais->pk_pais }}" 
                                        data-nombre="{{ $pais->nombre_pais }}"
                                        data-nacionalidad="{{$pais->nacionalidad}}">
                                            Editar
                                        </button>
                                        <button class="btn btn-delete">  
                                            <a href="{{ route('eliminar_pais', $pais->pk_pais) }}">Eliminar</a>
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
                            <form id="editForm" action="{{route('actualizar_pais')}}" method="POST">
                                @csrf
                                <input type="hidden" id="editId" name="id" >
                                <label for="editNombre">Nombre de posición:</label>
                                <input type="text" id="editNombre" name="nombre_pais" required>

                                <label for="editBandera">Bandera:</label>
                                <input type="file" id="editBandera" name="bandera_pais">

                                <label for="EditNacionalidad">Nacionalidad:</label>
                                <input type="text" id="editNacionalidad" name="nacionalidad" required>

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

    $('#formulario').on('submit', function(e) {

        e.preventDefault();
        var formulario = new FormData(this);
        var url = $(this).attr('action');
        formulario.append('bandera_pais', $('#bandera_pais')[0]);
        
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
        // Abrir el modal y cargar los datos
        $(document).on("click", ".openModal", function() {
            // Obtener los datos del botón
            var id = $(this).data("id");
            var nombre = $(this).data("nombre");
            var nacionalidad = $(this).data("nacionalidad")

            // Rellenar el formulario del modal
            $("#editId").val(id);
            $("#editNombre").val(nombre);
            $("#editNacionalidad").val(nacionalidad);
            

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