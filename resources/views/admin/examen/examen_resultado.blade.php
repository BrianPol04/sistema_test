@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Resultados del examen <span id="generarpdf" class="btn btn-success btn-sm mx-3"> <i class=" bx bxs-file-pdf fs-12"></i> PDF</span> </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">resultados</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div id="content">
            <div class="card mb-2">
                <div class="card-header pb-0 d-flex">
                    <ul class="list-unstyled vstack gap-3 ">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="assets/images/users/user-dummy-img.jpg" alt="" class="avatar-xs rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1"><a href="pages-profile.html">{{ $datos->name }}</a></h6>
                                    <p class="text-muted mb-0">{{ $datos->email }}</p>
                                    @php
                                        $tiempo_limite = strtotime($datos->tiempo_limite);
                                        $tiempo = strtotime($datos->tiempo);
                                        $diferencia = $tiempo_limite - $tiempo;

                                        $horas = floor($diferencia / 3600);
                                        $minutos = floor(($diferencia % 3600) / 60);
                                        $segundos = $diferencia % 60;

                                        $tiempo_usado_str = sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);
                                    @endphp

                                    <h6 class="mb-1">
                                        <a>
                                            Tiempo utilizado: {{ $tiempo_usado_str }} de {{ $datos->tiempo_limite }}
                                        </a>
                                    </h6>

                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="border-top border-top-dashed  ">
                        <h6 class="mb-3 fw-semibold text-uppercase">Resultados del examen <span class="text-muted"> COD: <b>{{ $datos->codigo_examen }}</b> </span></h6>
                        <div class="hstack flex-wrap gap-2 fs-15">
                            <div class="badge fw-medium badge-soft-success">Acertadas( <b>{{ $datos->buenas }} ) </b></div>
                            <div class="badge fw-medium badge-soft-danger">Aerróneas( <b>{{ $datos->malas }} ) </b></div>
                            <div class="badge fw-medium badge-soft-info">Sin responder( <b>{{ $datos->sinresponder }} ) </b></div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($preguntas as $key => $row)
                <div class="col-lg-12 col-md-12">
                    <div class="card mb-2">
                        <div class="card-body pb-0 ">
                            <div class="text-muted">
                                <h6 class="mb-1 fw-semibold text-uppercase">pregunta N° <b>{{ $key + 1 }}</b> </h6>
                                <p class=" mb-1 @if ($row->es_correcta) text-success @else text-danger @endif">{{ $row->pregunta }}</p>
                                <p class="mb-1 fw-semibold text-uppercase fs-12">Alternativas</p>
                                <ul class="ps-2 list-unstyled vstack gap-2">
                                    @if ($row->tipo_pregunta === 'Unica')
                                        @foreach ($row->respuestas as $item)
                                            <li>
                                                <div class="form-check @if ($row->es_correcta) form-check-success @else form-check-danger @endif">
                                                    <input class="form-check-input" type="radio" name="pregunta-{{ $item->pregunta_id }}" value="{{ $item->respuesta }}" id="radio{{ $item->id }}" @if (!is_null($resultado = $examen_resultado->where('id_pregunta', $item->pregunta_id)->first()) && $item->respuesta === $resultado->respuesta) checked @endif @if (is_null($resultado)) disabled @endif>
                                                    <label class="form-check-label" for="radio{{ $item->id }}">
                                                        {{ $item->respuesta }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if ($row->es_correcta === false)
                                            <li>
                                                <p class="mb-1 fw-semibold text-uppercase fs-12">Respuesta correcta</p>
                                            </li>
                                            <li>{{ $row->alternativa }}</li>
                                        @endif
                                    @else
                                        @foreach ($row->respuestas as $item)
                                            <li>
                                                <div class="form-check @if ($row->es_correcta) form-check-success @else form-check-danger @endif">
                                                    <input class="form-check-input" type="checkbox" name="pregunta-{{ $item->pregunta_id }}[]" value="{{ $item->respuesta }}" id="check{{ $item->id }}" @if (!is_null($resultado = $examen_resultado->where('id_pregunta', $row->id)->first()) && in_array($item->respuesta, json_decode($resultado->respuesta))) checked @endif>
                                                    <label class="form-check-label" for="check{{ $item->id }}">
                                                        {{ $item->respuesta }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                        @if ($row->es_correcta === false && $row->alternativa!='null')
                                            <li>
                                                <p class="mb-1 fw-semibold text-uppercase fs-12">Respuestas correctas</p>
                                            </li>

                                            @foreach (json_decode($row->alternativa) as $item)
                                                @if ($item !== null)
                                                    <li>
                                                        {{ $item }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {});
        const btn = document.getElementById("generarpdf");
        btn.addEventListener("click", function(e) {
            const contentElement = document.getElementById("content");
            var options = {
                margin: [5, 10],
                filename: "resultado del examen.pdf",
                pagebreak: {
                    mode: 'avoid-all'
                },
            };
            html2pdf()
                .from(contentElement)
                .set(options)
                .outputPdf()
                .save()
                .catch(function(error) {
                    console.error("Error al generar el PDF: ", error);
                });
        });
    </script>
@endsection
