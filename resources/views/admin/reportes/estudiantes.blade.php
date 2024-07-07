@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">DATOS USUARIO:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario" action="{{ route('alumno.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                            @if ($errors->any())
                                <script>
                                    $(document).ready(function() {
                                        $('#exampleModal').modal('show');
                                        $('#password-input').removeAttr('required');
                                        $('#opcional').html(' opcional');
                                    });
                                </script>
                            @endif
                            <div class="col-12">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="name" class="form-control @error('email') is-invalid @enderror" id="name" placeholder="escribe..." maxlength="255" value="{{ old('name') }}" required name="name">
                            </div>
                            <div class="col-12">
                                <label for="genero" class="form-label">Genero</label>
                                <select name="genero" id="genero" class="form-control" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>

                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Introduce tu correo electrónico" maxlength="255" value="{{ old('email') }}" required name="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="password-input" class="form-label">Contraseña &nbsp; <span class="text-info" id="opcional"></span></label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" name="password" placeholder="Enter password" id="password-input" required>
                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">alumnos</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">alumnos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <div class="flex-grow-1">
                        <div class="col-lg-6">
                            <h6 class="fw-semibold">selecciona un alumno</h6>
                            <select class="js-example-basic-single" name="state" onchange="Buscar(this)">
                                <option value="">seleccione...</option>
                                @foreach ($data as $row)
                                    <option value="{{ $row->curso_id }}" data-id="{{ $row->id }}">{{ $row->id }}-{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <table id="miTabla" class="table nowrap dt-responsive  table-hover   " style="width:100%">
                            <thead>
                                <tr class="table-active">
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody id="miCuerpoDeTabla">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="assets/js/pages/select2.init.js"></script>
    <script>
        const curso = @json($cursos);

        function Buscar(user) {
            const ids = JSON.parse(user.value);
            const selectedOption = user.options[user.selectedIndex];
            const id_user = selectedOption.getAttribute("data-id");
            const idAFiltrar = ids.map(id => parseInt(id, 10));
            const objetosFiltrados = curso.filter(objeto => idAFiltrar.includes(objeto.id));
            const cuerpoDeTabla = document.getElementById("miCuerpoDeTabla");

            while (cuerpoDeTabla.firstChild) {
                cuerpoDeTabla.removeChild(cuerpoDeTabla.firstChild);
            }

            objetosFiltrados.forEach(objeto => {
                const fila = cuerpoDeTabla.insertRow();
                const celdaID = fila.insertCell(0);
                const celdaNombre = fila.insertCell(1);
                const celdaDescripcion = fila.insertCell(2);

                celdaID.innerHTML = objeto.id;
                celdaNombre.innerHTML = objeto.nombre;
                celdaDescripcion.innerHTML = objeto.descripcion;
                fila.setAttribute('ondblclick', `Url(${objeto.id},${id_user});`);
                fila.classList.add('cursor-pointer');
            });
        }

        function Url(id,user_id) { 
            const encodedId = btoa(id);
            const id_user = btoa(user_id);
            const url = `{{ url('analisis') }}?cod=${encodedId}&id=${id_user}`;
            window.location.href = url;
        }
    </script>
@endsection
