@extends('layouts.app-admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>inventario</title>
    <!-- Añade Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        tam {
            font-size: 8rem;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <center><h1>LIBROS INVENTARIO</h1></center>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inventarioInicial">
        Inventario Inicial
    </button>
    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#ingresos">
        Ingresos
    </button>
    <!-- Modal INGRESOS -->
    <div class="modal fade" id="ingresos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ingresos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 mx-auto">
                                    <div class="table-responsive">
                                        @if ($ingresos->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">Nombre</th>
                                                        <th class="text-center align-middle">Cantidad</th>
                                                        <th class="text-center align-middle">Fecha Ingreso</th>
                                                        
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ingresos as $ingreso)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $ingreso->isbn }}</td>
                                                            <td class="text-center align-middle">{{ $ingreso->nombre_libro }}</td>
                                                            <td class="text-center align-middle">{{ $ingreso->cantidad }}</td>
                                                            <td class="text-center align-middle">{{ $ingreso->fecha_ingreso }}</td>
                                                        
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Sin Libros Registrados</p>
                                        @endif       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal INVENTARIO INICIAL -->
    <div class="modal fade" id="inventarioInicial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Inventario Inicial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 mx-auto">
                                    <div class="table-responsive">
                                        @if ($inventarioInicial->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">Titulo</th>
                                                        <th class="text-center align-middle">Cantididad en Sistema</th>                                                        
                                                        <th class="text-center align-middle">Autores</th>
                                                        <th class="text-center align-middle">Editorial</th>
                                                        <th class="text-center align-middle">Imagen</th>
                                                       
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($inventarioInicial as $inventarioI)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $inventarioI->isbn }}</td>
                                                            <td class="text-center align-middle">{{ $inventarioI->titulo }}</td>
                                                            <td class="text-center align-middle">{{ $inventarioI->cantidad_fisica }}</td>
                                                            <td class="text-center align-middle">{{ $inventarioI->autores }}</td>
                                                            <td class="text-center align-middle">{{ $inventarioI->nombre_editorial }}</td>
                                                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $inventarioI->imagen) }}" alt="" width="100" height="100"></td>
                                                            
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Sin Libros Registrados</p>
                                        @endif       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <center>
                <div class="col-md-12">
                    <div class="card shadow-xl">
                        <div class="card-header bg-primary text-white">
                            LIBROS
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 mx-auto">
                                    <div class="table-responsive">
                                        @if ($libros_todos->isNotEmpty())
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center align-middle">Nombre Libro</th>
                                                        <th class="text-center align-middle">Isbn</th>
                                                        <th class="text-center align-middle">N.0 Total</th>
                                                        <th class="text-center align-middle">Prestados</th>
                                                        <th class="text-center align-middle">Autores</th>
                                                        <th class="text-center align-middle">Categorias</th>
                                                        <th class="text-center align-middle">Disponibles</th>
                                                        <th class="text-center align-middle">Editorial</th>
                                                        <th class="text-center align-middle">Imagen</th>
                                                        <th class="text-center align-middle">OPCIONES</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($libros_todos as $libro)
                                                        <tr>
                                                            <td class="text-center align-middle">{{ $libro->nombre_libro }}</td>
                                                            <td class="text-center align-middle">{{ $libro->isbn_libros }}
                                                                <button>#</button>
                                                            </td>
                                                            <td class="text-center align-middle">{{ $libro->Suma_Total }}</td>
                                                            <td class="text-center align-middle">{{ $libro->cantidad_prestada }}</td>
                                                            <td class="text-center align-middle tam">{{ $libro->autores }}</td>
                                                            <td class="text-center align-middle tam">{{ $libro->categorias }}</td>
                                                            <td class="text-center align-middle tam">{{ $libro->Ejemplares_Disponibles }}</td>
                                                            <td class="text-center align-middle">{{ $libro->nombre_editorial }}</td>
                                                            <td class="text-center align-middle"><img src="{{ asset('storage/' . $libro->imagen) }}" alt="" width="100" height="100"></td>
                                                            <td class="text-center align-middle">
                                                                <!-- MODAL EDITAR-->
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="get_libro({{ $libro->id_libro }})" >
                                                                    Editar
                                                                </button>
                                                                <button class="btn btn-danger">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p class="text-center">Sin Libros Registrados</p>
                                        @endif       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Libro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarLibro">
                        <div class="mb-3">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nombreLibro" class="form-label">Nombre Libro</label>
                            <input type="text" class="form-control" id="nombreLibro" name="nombre_libro">
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" name="isbn" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea  class="form-control" id="descripcion" name="descripcion" cols="10" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="autores">AUTORES: <p>(Selecciona uno o varios autores)</p> </label>
                            <select id="autores" name="autores[]" class="form-control" multiple required>
                                @foreach($autores as $autor)
                                    <option value="{{ $autor->id_autor }}">{{ $autor->nombre_autor }} {{ $autor->apellido }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categorias">CATEGORIA:<p>(Selecciona uno o varias Cateogorias)</p> </label>
                            <select id="categorias" name="categorias[]" class="form-control" multiple required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editorial">EDITORIAL:</label>
                            <select id="editorial" name="editorial" class="form-control" required>
                                
                                @foreach($editorials as $editorial)
                                    <option value="{{ $editorial->id_editorial }}">{{ $editorial->nombre_editorial }}</option>
                                @endforeach
                            </select>
                        </div> 
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#autores').select2({
                placeholder: 'Selecciona uno o varios autores'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#categorias').select2({
                placeholder: 'Selecciona uno o varias categorias'
            });
        });
    </script>
    <script>
        function addAuthor() {
            const autoresContainer = document.getElementById('autores-container');
            const newAuthor = document.createElement('div');
            newAuthor.classList.add('autor-group');
            
            newAuthor.innerHTML = `
                <input type="text" name="autores[]" class="autor-input" placeholder="Nombre del autor" required>
                <button type="button" class="btn btn-sm btn-danger remove-autor-btn" onclick="removeAuthor(this)">Eliminar</button>
            `;
            
            autoresContainer.appendChild(newAuthor);
        }

        function removeAuthor(button) {
            const authorGroup = button.parentNode;
            authorGroup.remove();
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        async function guardarCambios() {
            // Obtener los valores de los inputs
            let id = document.getElementById('id').value;
            let titulo = document.getElementById('nombreLibro').value;
            let isbn = document.getElementById('isbn').value;
            //let paginas = document.getElementById('paginas').value;
            let descripcion = document.getElementById('descripcion').value;
            //let existencia = document.getElementById('existencia').value;
            let editorial = document.getElementById('editorial').value;
            
            // Obtener los IDs de los autores seleccionados
            let autores = $('#autores').val(); // Usamos jQuery para obtener los autores seleccionados
            let categorias = $('#categorias').val();
            // Obtener archivos
            //let imagen = document.getElementById('imagen').files[0];
            //let pdf = document.getElementById('pdf').files[0];

            // Validar que todos los campos estén llenos
            
    
            // Crear un objeto FormData para los datos del formulario
            let formData = new FormData();
            formData.append('nombreLibro', titulo);
            formData.append('isbn', isbn);
            //formData.append('paginas', paginas);
            formData.append('descripcion', descripcion);
            //formData.append('existencia', existencia);
            formData.append('editorial', editorial);
            //formData.append('imagen', imagen);
            //formData.append('pdf', pdf);
            
            // Agregar los autores seleccionados al FormData
            autores.forEach(function(autor) {
                formData.append('autores[]', autor);
            });

            categorias.forEach(function(categoria) {
                formData.append('categorias[]', categoria);
            });
    
            // Agregar el token CSRF de Laravel
            formData.append('_token', '{{ csrf_token() }}');
    
            // Hacer la petición fetch al backend
            try {
                let response = await fetch(`/admin/editar-libro/${id}/`, {
                    method: "POST",
                    body: formData
                });
                
                let data = await response.json();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: "Libro Actualizado Correctamente!",
                        confirmButtonText: "De Acuerdo",
                        //denyButtonText: `Don't save`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            //limpiar();
                            // Cierra el modal
                            let modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
                            modal.hide();
                            location.reload();
                            //Swal.fire("Saved!", "", "success");
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                    // Recargar la página o redirigir
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error de Registro",
                        text: "Fallo el Registro del Libro!",
                    });
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }
        function limpiar() {
            document.getElementById('titulo').value = '';
            document.getElementById('isbn').value = '';
            document.getElementById('paginas').value = '';
            document.getElementById('descripcion').value = '';
            document.getElementById('existencia').value = '';
            document.getElementById('editorial').value = '';
            document.getElementById('imagen').value = '';
            document.getElementById('pdf').value = '';
            //document.getElementById('autores[]').value = '';
            $('#autores').val(null).trigger('change');
        }
    </script>
    <!-- SCRIPT PARA AGARRAR LOS DATOS DE LA FILA Y MOSTRARLOS EN EL MODAL DE EDITAR-->
    <script>
        async function get_libro(id) {
            // Hacer una solicitud para obtener los datos del producto
            const response = await fetch(`/admin/get-libro/${id}/`);
            const libro = await response.json();
    
            // Llenar el formulario del modal con los datos del libro
            //document.getElementById('libro_id').value = libro.id;
            document.getElementById('nombreLibro').value = libro.nombre_libro;
            document.getElementById('isbn').value = libro.isbn;
            document.getElementById('descripcion').value = libro.descripcion;
            document.getElementById('autores').value = libro.autores;
            document.getElementById('editorial').value = libro.id_editorial;
            //document.getElementById('precio_edit').value = producto.precio;
            //document.getElementById('cantidad_edit').value = producto.cantidad;
            document.getElementById('id').value = libro.id_libro;
        }
    </script>

</body>
</html>
@endsection