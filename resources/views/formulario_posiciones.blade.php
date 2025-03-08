<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Formulario posiciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="formulario" action="{{ route('crear_posiciones') }}" method="POST">
                        @csrf 
                        <label for="nombre">Nombre de posición</label>
                        <input type="text" name="nombre" id="nombre" required>
                        <input class="btn btn-save" type="submit" value="Guardar">
                    </form>       

                   
                    <table>
                        <thead>
                            <tr>
                                <th>Posicion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posiciones as $posicion)
                            <tr>
                                <td>{{ $posicion->nombre }}</td>
                                <td>
                                    <button class="btn btn-edit openModal" 
                                            data-id="{{ $posicion->pk_posiciones }}" 
                                            data-nombre="{{ $posicion->nombre }}">
                                        Editar
                                    </button>
                                    <button class="btn btn-delete">
                                        <a href="{{ route('eliminar_posiciones', $posicion->pk_posiciones) }}">Eliminar</a>
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
                            <form id="editForm">
                                @csrf
                                <input type="hidden" id="editId" name="id"> <!-- Campo oculto para el ID -->
                                <label for="editNombre">Nombre de posición:</label>
                                <input type="text" id="editNombre" name="nombre" required>
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
        e.preventDefault(); // Evita que la página se recargue
            
        var formulario = $(this); // Obtener el formulario
        var url = formulario.attr('action'); // Obtener la URL de acción
        var datos = formulario.serialize(); // Serializar los datos del formulario

        $.ajax({
            url: url,
            type: 'POST',
            data: datos,
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: response.message
                }).then(() => {
                    location.reload(); // Recargar la página después de la alerta
                });
            },
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
    $(document).on("click", ".openModal", function() {

        var id = $(this).data("id");
        var nombre = $(this).data("nombre");

        $("#editId").val(id);
        $("#editNombre").val(nombre);

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

        // Enviar el formulario de edición mediante AJAX
        $("#editForm").on("submit", function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

            var formulario = $(this);
            var url = "{{ route('actualizar_posiciones') }}"; // URL para actualizar la posición
            var datos = formulario.serialize(); // Serializar los datos del formulario

            $.ajax({
                url: url,
                type: "POST",
                data: datos,
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: response.message
                    }).then(() => {
                        location.reload(); // Recargar la página después de la alerta
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Hubo un problema al actualizar la posición."
                    });
                }
            });
        });
    });

</script>
