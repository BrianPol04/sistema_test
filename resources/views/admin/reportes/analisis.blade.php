@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
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
                    <h4 class="card-title mb-0 flex-grow-1">Progreso del alumno</h4>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">

                        </div>
                        <div class="form-check form-switch form-switch-right form-switch-md">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Curso</th>
                                        <th scope="col">Examen</th>
                                        <th scope="col">tiempo realizado</th>
                                        <th scope="col">Progresos</th>
                                        <th scope="col">Puntaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->curso }}</td>
                                            <td>{{ $row->descripcion }}</td>
                                            <td>
                                                @php
                                                    $tiempo_limite = strtotime($row->tiempo_limite);
                                                    $tiempo = strtotime($row->tiempo);
                                                    $diferencia = $tiempo_limite - $tiempo;

                                                    $horas = floor($diferencia / 3600);
                                                    $minutos = floor(($diferencia % 3600) / 60);
                                                    $segundos = $diferencia % 60;

                                                    $tiempo_usado_str = sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
                                                @endphp

                                                <a>
                                                    {{ $tiempo_usado_str }} de {{ $row->tiempo_limite }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="progress progress-sm">
                                                    @if ($row->buenas_p >= 50)
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $row->buenas_p }}%" aria-valuenow="{{ $row->buenas_p }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @elseif($row->buenas_p >= 30)
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $row->buenas_p }}%" aria-valuenow="{{ $row->buenas_p }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @else
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $row->buenas_p }}%" aria-valuenow="{{ $row->buenas_p }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if ($row->buenas_p >= 50)
                                                    <a href="javascript:void(0);" class="link-success">{{ $row->buenas_p }}%</a>
                                                @elseif($row->buenas_p >= 30)
                                                    <a href="javascript:void(0);" class="link-warning">{{ $row->buenas_p }}%</a>
                                                @else
                                                    <a href="javascript:void(0);" class="link-danger">{{ $row->buenas_p }}%</a>
                                                @endif
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
