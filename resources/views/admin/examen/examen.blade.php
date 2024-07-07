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
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-body text-center">
                    <h6 class="card-title mb-3 flex-grow-1 text-center">Duración del exemen</h6>
                    <div class="mb-2">
                        <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop" colors="primary:#405189,secondary:#02a8b5" style="width:90px;height:90px"></lord-icon>
                    </div>
                    <h3 class="mb-1" id="countdown">{{ $examen_alumno->tiempo }}</h3>
                    <h5 class="fs-14 mb-4"> Total de preguntas <b> {{ count($preguntas) }} </b></h5>
                    <div class="hstack gap-2 justify-content-center">
                        <a class="btn btn-success  btn-sm cursor-pointer" onclick="saveFormAutomatically();"><i class="ri-stop-circle-line align-bottom me-1"></i> Finalizar examen</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-9">
            <div data-simplebar data-simplebar-direction="rtl" class="px-3 vh-100 pb-5">
                <form id="miFormulario" class="row" action="{{ route('examenresulto.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_examen_alumno" value="{{ base64_encode($examen_alumno->id) }}">
                    @foreach ($preguntas as $key => $row)
                        <div class="col-lg-12 col-md-12">
                            <div class="card mb-2">
                                <div class="card-body pb-0 ">
                                    <div class="text-muted">
                                        <h6 class="mb-1 fw-semibold text-uppercase">pregunta N° <b>{{ $key + 1 }}</b> </h6>
                                        <p>{{ $row->pregunta }} </p>
                                        <h6 class="mb-2 fw-semibold text-uppercase">Alternativas</h6>
                                        <ul class="ps-2 list-unstyled vstack gap-2">
                                            @if ($row->tipo_pregunta === 'Unica')
                                                @foreach ($row->respuestas as $item)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="pregunta-{{ $item->pregunta_id }}" value="{{ $item->respuesta }}" id="radio{{ $item->id }}">
                                                            <label class="form-check-label" for="radio{{ $item->id }}">
                                                                {{ $item->respuesta }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                @foreach ($row->respuestas as $item)
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="pregunta-{{ $item->pregunta_id }}[]" value="{{ $item->respuesta }}" id="check{{ $item->id }}">
                                                            <label class="form-check-label" for="check{{ $item->id }}">
                                                                {{ $item->respuesta }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <a class="btn btn-success cursor-pointer" onclick="saveFormAutomatically();"><i class="ri-stop-circle-line align-bottom me-1"></i> Finalizar examen</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const examen_alumno = @json($examen_alumno);

        function updateCountdown() {
            const countdownElement = document.getElementById('countdown');
            let time = countdownElement.innerHTML.split(':');
            let hours = parseInt(time[0]);
            let minutes = parseInt(time[1]);
            let seconds = parseInt(time[2]);

            if (hours === 0 && minutes === 0 && seconds === 0) {
                saveFormAutomatically();
            } else {
                if (seconds === 0) {
                    if (minutes === 0) {
                        hours--;
                        minutes = 59;
                        seconds = 59;
                    } else {
                        minutes--;
                        seconds = 59;
                    }
                } else {
                    seconds--;
                }

                let tmpformat = (hours < 10 ? '0' : '') + hours + ':' +
                    (minutes < 10 ? '0' : '') + minutes + ':' +
                    (seconds < 10 ? '0' : '') + seconds;

                countdownElement.innerHTML = tmpformat;
                updateTiempo(examen_alumno.id, tmpformat);
            }
        }

        function saveFormAutomatically() {
            const form = document.getElementById('miFormulario');
            fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        console.error('Error al guardar el formulario automáticamente.');
                    }
                })
                .then(data => {
                    window.addEventListener('popstate', function() {
                        history.pushState(null, null, data.url);
                    });
                    if (data && data.url) {
                        window.location.replace(data.url);
                    }
                })
                .catch(error => {
                    console.error('Error al realizar la solicitud.');
                });
        }

        function updateTiempo(id, minutes) {
            const requestBody = {
                id: id,
                tiempo: minutes
            };

            fetch("{{ route('update_tiempo') }}", {
                    method: 'POST',
                    body: JSON.stringify(requestBody),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Minuto actualizado en la base de datos.');
                    } else {
                        console.error('Error al actualizar el minuto en la base de datos.');
                    }
                })
                .catch(error => {
                    console.error('Error al realizar la solicitud AJAX.');
                });
        }

        if (examen_alumno.estado !== 'completado') {
            setInterval(updateCountdown, 1000);
        }
    </script>
@endsection
