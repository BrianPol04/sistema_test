@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="modal fade" id="examenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">Generar Examen </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario" action="{{ route('examen.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row">
                                    <input type="hidden" name="tema_id" id="tema_id">
                                    <div class="col-12 mb-2">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="cantidad" class="form-label">Cantidad de pregunta</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="tiempo_limite" class="form-label">Tiempo limite</label> 
                                        <input type="time" class="form-control" id="tiempo_limite" name="tiempo_limite" value="00:00:00" required step="1" pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}">

                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="fecha_hora_inicio" class="form-label">Fecha y hora de Inicio</label>
                                        <input type="datetime-local" class="form-control" id="fecha_hora_inicio" name="fecha_hora_inicio" required>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="fecha_hora_fin" class="form-label">Fecha y hora de Fin</label>
                                        <input type="datetime-local" class="form-control" id="fecha_hora_fin" name="fecha_hora_fin" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label for="curso_id" class="form-label">Seleccione curso</label>
                                        <select name="curso_id" id="curso_id" class="form-control" required>
                                            <option value="">seleccione...</option>
                                            @foreach ($cursos as $row)
                                                <option value="{{ $row->id }}"> {{ $row->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="cantidad" class="form-label">Seleccione temas</label>
                                        <table id="tabla-temas" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Temas</th>
                                                    <th><input type="checkbox" id="selectAll"> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
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
                <h4 class="mb-sm-0">generar examen</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">examen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Lista de examen activos</h4>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">
                            <button type="button" class="btn btn-primary" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#examenModal">Nuevo Examen</button>
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
                                    <th style="width:10%">#</th>
                                    <th style="width:50%">Nombre</th>
                                    <th style="width:40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr ondblclick="window.location.href = '{{ url('preguntas?cod=') . base64_encode($row->id) }}';" class="cursor-pointer">
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->descripcion }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-soft-info" onclick="Editar({{ $row }})">Editar</a>
                                            <a href="{{ route('temas.delete', $row->id) }}" class="btn btn-sm btn-soft-danger">Eliminar</a>
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

    <script>
        $(document).ready(function() {
            const temas = @json($temas);
            $('#curso_id').on('change', function() {
                var curso_id = $(this).val();
                if (curso_id) {
                    var temasFiltrados = temas.filter(function(tema) {
                        return tema.curso_id == curso_id;
                    });
                    $('#tabla-temas tbody').empty();
                    $.each(temasFiltrados, function(index, tema) {
                        $('#tabla-temas tbody').append(
                            `<tr>
                            <td>${tema.nombre}</td>
                            <td><input type="checkbox" name="temas[]" value="${tema.id}"></td>
                        </tr>`
                        );
                    });
                    checkboxs = document.querySelectorAll('input[name="temas[]"]');
                } else {
                    $('#tabla-temas tbody').empty();
                    checkboxs = document.querySelectorAll('input[name="temas[]"]');
                }
            });
            const selectAll = document.getElementById('selectAll');
            let checkboxs = document.querySelectorAll('input[name="temas[]"]');
            selectAll.addEventListener('click', function() {
                for (var i = 0; i < checkboxs.length; i++) {
                    checkboxs[i].checked = selectAll.checked;
                }
            });
        });

        function Nuevo() {
            $('#id').val(0);
            $("#miFormulario")[0].reset();
            $('#password-input').attr('required');
            $('#opcional').html('');
        }

        function Examen(data) {
            $('#tema_id').val(data.id);
            $('#examenModal').modal('show');
        }

        function Editar(data) {
            Object.keys(data).forEach(function(key) {
                let value = data[key];
                $('#' + key).val(value);
            });
            $('#examenModal').modal('show');
        }
    </script>
@endsection
