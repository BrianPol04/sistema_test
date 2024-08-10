@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">DATOS USUARIO:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario" action="{{ route('profesor.create') }}" method="post" enctype="multipart/form-data">
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
                <h4 class="mb-sm-0">profesor</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">profesor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Lista de profesores</h4>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">
                            <button type="button" class="btn btn-primary" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#exampleModal"> AGREGAR <i class="bx bxs-user-plus" style="font-size: 16px"></i>
                            </button>
                        </div>
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:15%">Nombres</th>
                                    <th style="width:50%">Email</th>
                                    <th style="width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-soft-info" onclick="Editar({{ $row }})"> <i class="ri-edit-2-line"></i></a>
                                            <a href="{{ route('usuario.delete', $row->id) }}" class="btn btn-sm btn-soft-danger"> <i class="ri-delete-bin-line"></i> </a>
                                            <a class="btn btn-sm btn-soft-success cursor-pointer" onclick="Cursos({{ json_encode($row) }});"> Cursos</a> 
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    <div class="modal fade" id="cursoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Asociar Profesor con cursos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profesor.cursos') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="usuario_id">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Asociar</button>
                        </div>
                        <table class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Cursos</th>
                                    <th><input type="checkbox" id="selectAll"> Acceso </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $sede)
                                    <tr>
                                        <td> {{ $sede->nombre }}</td>
                                        <td>
                                            <input type="checkbox" name="cursos[]" id="cursos{{ $sede->id }}" value="{{ $sede->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
    <script>
        var selectAllCheckbox = document.getElementById('selectAll');
        var accessCheckboxes = document.querySelectorAll('input[name="cursos[]"]');
        selectAllCheckbox.addEventListener('click', function() {
            for (var i = 0; i < accessCheckboxes.length; i++) {
                accessCheckboxes[i].checked = selectAllCheckbox.checked;
            }
        });
        function Nuevo() {
            $('#id').val(0);
            $("#miFormulario")[0].reset();
            $('#password-input').attr('required');
            $('#opcional').html('');
        }
        function Editar(data) {
            Object.keys(data).forEach(function(key) {
                let value = data[key];
                $('#' + key).val(value);
            });
            $('#password-input').removeAttr('required');
            $('#opcional').html(' opcional');
            $('#exampleModal').modal('show');
        }
        function Cursos(param) {
            $('#usuario_id').val(param.id);
            $('input[name="cursos[]"]').prop('checked', false);
            let sedeIds = JSON.parse(param.curso_id);
            sedeIds.forEach(function(id) {
                $('#cursos' + id).prop('checked', true);
            });
            $('#cursoModal').modal('show');
        }
    </script>
@endsection
