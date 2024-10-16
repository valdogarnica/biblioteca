@extends('layouts.app-admin')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos generales para la tarjeta */
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .card-header {
            font-size: 1.8em;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .card-body {
            padding: 20px;
        }

        /* Estilos para los inputs y etiquetas del formulario */
        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
        }

        /* Estilos para los botones */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .bt,
        .bt {
            border-color: 2px solid #2be10b;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 48%;
            text-align: center;
        }

        .btn-guardar:hover {
            background-color: #1c9c0cb3;
        }

        .btn-cancelar {
            background-color: #6c757d;
        }

        .btn-cancelar:hover {
            background-color: #5a6268;
        }

        /* Estilos específicos para el input de archivos */
        .custom-file-input {
            position: relative;
            width: 100%;
            height: 40px;
            cursor: pointer;
            opacity: 0;
        }

        .custom-file-label {
            position: relative;
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            font-size: 1em;
            color: #555;
            cursor: pointer;
        }

        .custom-file-label::before {
            content: 'Seleccionar archivo';
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border-radius: 4px;
            margin-right: 10px;
            display: inline-block;
        }

        .custom-file-input:focus + .custom-file-label {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Responsividad para pantallas más pequeñas */
        @media (max-width: 768px) {
            .form-group {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-guardar,
            .btn-cancelar {
                width: 100%;
                margin-bottom: 10px;
            }
        }

     </style>
</head>
<body>
    <main> 
        <div class="card">
            <div class="card-header">
                <h1>AGREGAR LIBRO</h1>
            </div>
            <div class="card-body">
                <form id="bookForm" class="book-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="titulo">TÍTULO LIBRO:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="editorial">EDITORIAL:</label>
                        <select id="editorial" name="editorial" class="form-control" required>
                            <option value="">Selecciona Editorial</option>
                            @foreach($editorials as $editorial)
                                <option value="{{ $editorial->id_editorial }}">{{ $editorial->nombre_editorial }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN*:</label>
                        <input type="number" id="isbn" name="isbn" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="paginas">N.º pág.:</label>
                        <input type="number" id="paginas" class="form-control" name="paginas">
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
                        <label for="descripcion">DESCRIPCIÓN:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Breve Descripción"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="existencia">Libros en Existencia</label>
                        <input type="number" name="existencia" id="existencia" class="form-control" placeholder="Agrega la Cantidad de Libros en Existencia" required>
                    </div>
                    <div class="form-group">
                        <label for="Imagen" >Agrega Imagen</label>
                        <input type="file" name="imagen" id="imagen">
                    </div>
                    <div class="form-group">
                        <label for="pdf">Agregar Libro Digital</label>
                        <input type="file" name="pdf" id="pdf">
                    </div>
                    <div class="button-group">
                        <button type="button" class="btn btn-outline-success bt" onclick="submitForm()">GUARDAR</button>
                        <button type="reset" class="btn btn-outline-secondary bt">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Añade Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#autores').select2({
                    placeholder: 'Selecciona uno o varios autores'
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
            async function submitForm() {
                // Obtener los valores de los inputs
                let titulo = document.getElementById('titulo').value;
                let isbn = document.getElementById('isbn').value;
                let paginas = document.getElementById('paginas').value;
                let descripcion = document.getElementById('descripcion').value;
                let existencia = document.getElementById('existencia').value;
                let editorial = document.getElementById('editorial').value;
                
                // Obtener los IDs de los autores seleccionados
                let autores = $('#autores').val(); // Usamos jQuery para obtener los autores seleccionados
                
                // Obtener archivos
                let imagen = document.getElementById('imagen').files[0];
                let pdf = document.getElementById('pdf').files[0];

                // Validar que todos los campos estén llenos
                if (!titulo || !isbn || !paginas || !descripcion || !existencia || !editorial || autores.length === 0 || !imagen || !pdf) {
                    Swal.fire({
                        icon: "warning",
                        title: "Campos Vacíos",
                        text: "Por favor, completa todos los campos antes de enviar.",
                    });
                    return; // Detener la ejecución si faltan campos
                }
        
                // Crear un objeto FormData para los datos del formulario
                let formData = new FormData();
                formData.append('titulo', titulo);
                formData.append('isbn', isbn);
                formData.append('paginas', paginas);
                formData.append('descripcion', descripcion);
                formData.append('existencia', existencia);
                formData.append('editorial', editorial);
                formData.append('imagen', imagen);
                formData.append('pdf', pdf);
                
                // Agregar los autores seleccionados al FormData
                autores.forEach(function(autor) {
                    formData.append('autores[]', autor);
                });
        
                // Agregar el token CSRF de Laravel
                formData.append('_token', '{{ csrf_token() }}');
        
                // Hacer la petición fetch al backend
                try {
                    let response = await fetch("{{ route('agregar.libro') }}", {
                        method: "POST",
                        body: formData
                    });
                    
                    let data = await response.json();
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: "Libro Guardado Correctamente!",
                            confirmButtonText: "OK",
                            //denyButtonText: `Don't save`
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            limpiar();
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
        
        
        
        <!-- Modal PARA ELIMINAR PRODUCTOS -->
        <div class="modal fade" id="abreModal" tabindex="2" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel">¡Eliminar Producto!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="successModalBody">
                        <!-- Mensaje de éxito aquí -->
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger">Confirmar</button>
                        <!--button class="btn btn-info" onclick="mostrarTicket()">Mostrar Ticket</button-->
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> <!-- aqui antes limpiaba la tabla-->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
@endsection