@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <style>
        .responsive-cell {
            white-space: normal; 
            word-wrap: break-word; 
            max-width: 100%; 
        }
    </style>
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">DATOS DE LA PREGUNTA :</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario" action="{{ route('preguntas.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                            <input type="hidden" name="tema_id" id="tema_id" value="{{ $id_tema }}">
                            <input type="hidden" name="respuestas" id="respuestas">

                            <div class="col-12 mb-2">
                                <label for="pregunta" class="form-label">Preguntas</label>
                                <textarea name="pregunta" id="pregunta" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="name" class="form-label">Tipo de respuesta</label>
                                <select name="tipo_pregunta" onchange="ResetAlternaviva(this)" id="tipo_pregunta" class="form-control rounded-pill">
                                    <option value="Unica">única</option>
                                    <option value="Multiple">multiple</option>
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="name" class="form-label">ingrese la respuesta</label>
                                <div class="input-group gap-2">
                                    <input type="text" id="tex_respuesta" class="form-control rounded-pill">
                                    <a id="agregar-alternativa" class="btn btn-primary rounded-pill">Agregar alternativa</a>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="name" class="form-label">luego marque la respuesta</label>
                                <div class="alternativas">

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
                <h4 class="mb-sm-0">preguntas</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">preguntas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Lista de preguntas</h4>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">
                            <button type="button" class="btn btn-primary" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#exampleModal"> Nueva Pregunta </button>
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
                                    <th style="width:70%" data-priority="1">Pregunta</th>
                                    <th style="width:10%">Tipo</th>
                                    <th style="width:15%" data-priority="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td data-responsive>
                                            <span class="responsive-cell">
                                                {{ $row->pregunta }}
                                            </span>
                                        </td>
                                        <td>{{ $row->tipo_pregunta }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-soft-info" onclick="Editar(JSON.stringify({{ $row }}));">Editar</a>
                                            <a href="{{ route('usuario.delete', $row->id) }}" class="btn btn-sm btn-soft-danger">Eliminar</a>
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
        let data_alternativa = [];

        $(document).ready(function() {
            $('#agregar-alternativa').click(function() {
                var tipoPregunta = $('#tipo_pregunta').val();
                var textoRespuesta = $('#tex_respuesta').val();

                if (textoRespuesta.trim() !== '') {
                    $('#tex_respuesta').val('');
                    var nuevaAlternativa = {
                        respuesta: textoRespuesta,
                        es_correcta: false
                    };
                    if (tipoPregunta === 'Unica') {
                        $('.alternativas').append(` 
                            <div class="form-check form-radio-info mb-3">
                                <input class="form-check-input" type="radio" name="alternativa" value="${textoRespuesta}" onchange="updateres(this, ${data_alternativa.length})">
                                <label class="form-check-label" for="formradioRight5">
                                    ${textoRespuesta}
                                </label>
                                <i   class=" ri-delete-bin-2-fill eliminar-alternativa" data-index="${data_alternativa.length}"></i>
                            </div>
                        `);
                    } else if (tipoPregunta === 'Multiple') {
                        $('.alternativas').append(`
                            <div class="form-check  form-check-success  mb-3">
                                <input class="form-check-input" type="checkbox" onchange="updateres(this, ${data_alternativa.length})" id="formCheck${data_alternativa.length}" name="alternativa[]" value="${textoRespuesta}">
                                <label class="form-check-label" for="formCheck${data_alternativa.length}">
                                    ${textoRespuesta}
                                </label>
                                <i   class=" ri-delete-bin-2-fill eliminar-alternativa" data-index="${data_alternativa.length}"></i>
                            </div> 
                        `);
                    }
                    data_alternativa.push(nuevaAlternativa);
                    $('#respuestas').val(JSON.stringify(data_alternativa));
                }
            });

            $('.alternativas').on('click', '.eliminar-alternativa', function() {
                $(this).closest('.form-check').remove();
                var index = $(this).data('index');
                data_alternativa.splice(index, 1);
                $('#respuestas').val(JSON.stringify(data_alternativa));
            });
        });

        function updateres(element, index) {
            let tipo = $('#tipo_pregunta').val();
            if (tipo === 'Unica') {
                for (var i = 0; i < data_alternativa.length; i++) {
                    data_alternativa[i].es_correcta = false;
                }
            }
            data_alternativa[index].es_correcta = element.checked;
            $('#respuestas').val(JSON.stringify(data_alternativa));
        }

        function Nuevo() {
            $('#id').val(0);
            $("#miFormulario")[0].reset();
            $('#password-input').attr('required');
            $('#opcional').html('');
        }

        function Editar(row) {
            let data = JSON.parse(row);
            ResetAlternaviva();
            if (data.tipo_pregunta === 'Unica') {
                data.respuestas.forEach((element, key) => {
                    data_alternativa.push(element);
                    const isChecked = element.es_correcta == 1 ? 'checked' : '';
                    $('.alternativas').append(` 
                        <div class="form-check form-radio-info mb-3">
                            <input class="form-check-input" type="radio" name="alternativa" value="${element.respuesta}" id="formradio${key}" onchange="updateres(this, ${key})" ${isChecked}>
                            <label class="form-check-label" for="formradio${key}">
                                ${element.respuesta}
                            </label>
                            <i class="ri-delete-bin-2-fill eliminar-alternativa" data-index="${key}"></i>
                        </div>
                    `);
                });
            } else if (data.tipo_pregunta === 'Multiple') {
                data.respuestas.forEach((element, key) => {
                    data_alternativa.push(element);
                    const isChecked = element.es_correcta == 1 ? 'checked' : '';
                    $('.alternativas').append(`
                        <div class="form-check  form-check-success  mb-3">
                            <input class="form-check-input" type="checkbox" onchange="updateres(this, ${key})" id="formCheck${key}" name="alternativa[]" value="${element.respuesta}" ${isChecked}>
                            <label class="form-check-label" for="formCheck${key}">
                                ${element.respuesta}
                            </label>
                            <i class="ri-delete-bin-2-fill eliminar-alternativa" data-index="${key}"></i>
                        </div> 
                    `);
                });
            }
            $('#id').val(data.id);
            $('#pregunta').val(data.pregunta);
            $('#tipo_pregunta').val(data.tipo_pregunta);
            $('#tema_id').val(data.tema_id);
            $('#respuestas').val(JSON.stringify(data_alternativa));
            $('#exampleModal').modal('show');
        }

        function ResetAlternaviva() {
            $('.alternativas').html('');
            data_alternativa = [];
        }
    </script>
@endsection
