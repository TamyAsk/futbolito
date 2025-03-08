<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ligas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="formulario" action="{{route('guardar_ligas')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="">Nombre de la liga</label>
                        <input type="text" name="nombre">

                        <label for="">Imagen de la liga</label>
                        <input type="file" name="logo_ligas">

                        <label for="">Pais</label>
                        <select name="fk_pais" id="">
                            <option value="">Selecciona una opcion</option>
                            @foreach($pais as $paises)
                            <option value="{{$paises->pk_pais }}">{{ $paises->nombre_pais }}</option>
                            @endforeach
                        </select>
                        
                        <input class="btn btn-save" type="submit" value="Guardar">
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>Liga</th>
                                <th>Logo</th>
                                <th>Pais</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ligas as $liga)
                                <tr>
                                    <td>{{$liga->nombre}}</td>
                                    <td><img src="{{Storage::url($liga->logo_ligas)}}" alt="" width="100px"></td>
                                    <td>{{$liga->pais->nombre_pais}}</td>
                                    <td>
                                        <button class="btn btn-edit openModal" 
                                        data-id="{{$liga->pk_ligas}}" 
                                        data-nombre="{{$liga->nombre}}"
                                        data-pais="{{$liga->fk_pais}}">
                                            Editar
                                        </button>
                                        <button class="btn btn-delete">
                                            <a href="{{route('eliminar_ligas',$liga->pk_ligas)}}">Eliminar</a>
                                        </button>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <p>Editar posición</p>
                            <form id="editForm" action="{{route('actualizar_ligas')}}" method="POST">
                                @csrf
                                <input type="hidden" id="editId" name="id" >
                                <label for="editNombre">Nombre de posición:</label>
                                <input type="text" id="editNombre" name="nombre" required>

                                <label for="editLogo">Logo:</label>
                                <input type="file" id="editLogo" name="logo_ligas">

                                <label for="EditPais">Pais:</label>
                                <select name="fk_pais" id="editPais">
                                    <option value="">Selecciona una opcion</option>
                                @foreach($pais as $paises)
                                <option value="{{$paises->pk_pais }}">{{ $paises->nombre_pais }}</option>
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

    $('#formulario').on('submit', function(e) {

    e.preventDefault();
    var formulario = new FormData(this);
    var url = $(this).attr('action');
    formulario.append('logo_ligas', $('#logo_ligas')[0]);

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