@extends('admin.layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Examenes activos</h4>
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
            <div class="card vh-100">
                <div class="card-body">
                    <div class="row">
                        @foreach ($data as $row)
                            <div class="col-xxl-6">
                                <div class="card card-height-100">
                                    <div class="card-body pt-0">
                                        <ul class="list-group list-group-flush border-dashed">
                                            <li class="list-group-item ps-0">
                                                <div class="row align-items-center g-3">
                                                    <div class="col-auto">
                                                        <div class="avatar-md p-1 py-2 h-auto bg-light rounded-3">
                                                            <div class="text-center">
                                                                <h3 class="mb-3">
                                                                    <b>{{ \Carbon\Carbon::parse($row->fecha_hora_inicio)->day }}</b>
                                                                </h3>
                                                                <div class="text-muted">
                                                                    <b>{{ \Carbon\Carbon::parse($row->fecha_hora_inicio)->formatLocalized('%B') }} </b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="text-muted mt-0 mb-1 fs-13">
                                                            <b>Horas: </b> 
                                                            {{ \Carbon\Carbon::parse($row->fecha_hora_inicio)->format('h:ia') . ' - ' . \Carbon\Carbon::parse($row->fecha_hora_fin)->format('h:ia') }} 
                                                        </h5>
                                                        <a class="text-reset fs-14 mb-0">{{ $row->descripcion }}</a>
                                                        <div class=" border-top border-top-dashed mt-1 pt-1">
                                                            <div class="hstack flex-wrap gap-2 fs-15 ">
                                                                @if ($row->verify === false && $row->estado === 0)
                                                                    <div class="badge fw-medium badge-soft-danger">No dio su examen</div>
                                                                @elseif ($row->verify === false && $row->estado === 1) 
                                                                    @if (\Carbon\Carbon::now()->isBetween(\Carbon\Carbon::parse($row->fecha_hora_inicio), \Carbon\Carbon::parse($row->fecha_hora_fin)))
                                                                        <div class="badge fw-medium badge-soft-info cursor-pointer" onclick="Confirm('{{ url('examenconfig?cod=') . base64_encode($row->id) }}')">Iniciar examen</div>
                                                                    @else
                                                                        <small class="text-info">¡aún no esta dentro de las horas de examen.!</small>
                                                                    @endif
                                                                @else
                                                                    <div class="badge fw-medium badge-soft-success ">Realizado</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item">
                                                                <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Creado por {{ $row->name }}">
                                                                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function Confirm(url) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Quieres Empezar con el examen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
@endsection
