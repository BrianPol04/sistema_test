@extends('admin.layouts.app')
@section('title', 'reporte de examen')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Información de Resultados del Examen </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">resultados</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xxl-10">
            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4 pb-1">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <img src="assets/images/logo-dark.png" class="card-logo card-logo-dark" alt="logo dark" height="17">
                                    <img src="{{ $config_sis->logo_light }}" class="card-logo card-logo-light" alt="logo light" height="17">
                                    {{-- <div class="mt-sm-3 mt-3">
                                        <h6 class="text-muted text-uppercase fw-semibold">Address</h6>
                                        <p class="text-muted mb-1" id="address-details">California, United States</p> 
                                    </div> --}}
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3"> 
                                    <h6><span class="text-muted fw-normal">De:</span><span id="email">{{ $config_sis->nombre }} </span></h6>
                                    {{-- <h6><span class="text-muted fw-normal">Website:</span> <a href="https://themesbrand.com/" class="link-primary" target="_blank" id="website">www.themesbrand.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No:  </span><span id="contact-no"> +(01) 234 6789</span></h6> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="acitivity-timeline ">
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-soft-success text-success">
                                                        <i class="ri-bookmark-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1 text-uppercase fs-12"> <b>Descripción Examen</b> </p>
                                                <p class="text-muted mb-1">{{ $examen->descripcion }}</p>
                                                <p class="text-muted mb-1">día: <b>{{ \Carbon\Carbon::parse($examen->fecha_hora_inicio)->day }} {{ \Carbon\Carbon::parse($examen->fecha_hora_inicio)->formatLocalized('%B') }}</b></p>
                                                <small class="mb-0 text-muted">Horas:
                                                    <b class="text-uppercase">
                                                        {{ \Carbon\Carbon::parse($examen->fecha_hora_inicio)->format('h:ia') . ' - ' . \Carbon\Carbon::parse($examen->fecha_hora_fin)->format('h:ia') }}
                                                    </b>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="acitivity-item d-flex py-3 ">
                                            <div class="flex-shrink-0">
                                                <img class="avatar-xs rounded-circle acitivity-avatar" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1 text-uppercase fs-12"> <b>Creado por: <span class="fw-semibold">{{ $examen->name }}</span></b> </p>
                                                <p class="mb-0 text-muted"> <small><b>{{ $examen->created_at }} {{ \Carbon\Carbon::parse($examen->created_at)->format('A') }}</b></small> </p>
                                            </div>
                                        </div>
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs acitivity-avatar">
                                                    <div class="avatar-title rounded-circle bg-soft-warning text-warning">
                                                        <i class="ri-line-chart-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <p class="mb-1 text-uppercase fs-12  "> <b>Duración</b> </p>
                                                <p class="text-muted mb-1">Tiempo limite: <span class="text-primary"> {{ $examen->tiempo_limite }}</span></p>
                                                <small class="mb-0 text-muted">Total de preguntas:
                                                    <span class="text-primary"> {{ $examen->cantidad }}</span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" id="elementoAEliminar">
                                    <div id="images_scatter" data-colors='["--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width:5%">#</th>
                                            <th scope="col" style="width:40%">Alumno</th>
                                            <th scope="col" class="text-center" style="width:10%">Sin responder</th>
                                            <th scope="col" class="text-center" style="width:10%">Erróneas</th>
                                            <th scope="col" class="text-center" style="width:10%">Acertadas</th>
                                            <th scope="col" class="text-end" style="width:15%">Puntaje</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        @php
                                            $_aprobados = $_desaprobados = 0;
                                            $_maxBuenasP = -INF;
                                            $_minBuenasP = INF;
                                            $listdataDesc = $data->sortByDesc('buenas_p');

                                        @endphp
                                        @foreach ($listdataDesc as $row)
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td class="text-center">{{ $row->sinresponder }}</td>
                                                <td class="text-center">{{ $row->malas }}</td>
                                                <td class="text-center">{{ $row->buenas }}</td>
                                                <td class="text-end">
                                                    @if ($row->buenas_p > $_maxBuenasP)
                                                        @php $_maxBuenasP = $row->buenas_p; @endphp
                                                    @endif

                                                    @if ($row->buenas_p < $_minBuenasP)
                                                        @php $_minBuenasP = $row->buenas_p; @endphp
                                                    @endif
                                                    @if ($row->buenas_p >= 50)
                                                        @php $_aprobados++;  @endphp
                                                        <p class="text-success fw-medium fs-12 mb-0"><i class="ri-arrow-up-s-fill fs-5 align-middle"></i>{{ round($row->buenas_p, 2) }} % </p>
                                                    @else
                                                        @php $_desaprobados++;  @endphp
                                                        <p class="text-danger fw-medium fs-12 mb-0"><i class="ri-arrow-down-s-fill fs-5 align-middle"></i>{{ round($row->buenas_p, 2) }} % </p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="border-top border-top-dashed mt-2 pt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                    <tbody>
                                        <tr class="border-bottom  border-bottom-dashed">
                                            <td class="text-muted py-1">Total de aprobados </td>
                                            <td class="text-end py-1"> <b>{{ $_aprobados }} </b></td>
                                        </tr>
                                        <tr class="border-bottom  border-bottom-dashed">
                                            <td class="text-muted py-1">Total desaprobados</td>
                                            <td class="text-end py-1"><b>{{ $_desaprobados }}</b></td>
                                        </tr>
                                        <tr class="border-bottom  border-bottom-dashed">
                                            <td class="text-muted py-1">Puntaje minimo </td>
                                            <td class="text-end py-1">{{ $_minBuenasP }}%</td>
                                        </tr>
                                        <tr class="border-bottom  border-bottom-dashed">
                                            <td class="text-muted py-1">Puntaje maximo</td>
                                            <td class="text-end py-1"> {{ $_maxBuenasP }}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="mt-4">
                                <div class="alert alert-info">
                                    <p class="mb-0"><span class="fw-semibold">NOTES:</span>
                                        <span id="note"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt consequatur autem veritatis inventore mollitia ipsam. Quaerat cumque blanditiis quidem, minus, odio nihil autem deserunt dolorem alias sed esse culpa et?
                                        </span>
                                    </p>
                                </div>
                            </div> --}}
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Imprimir </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>

    <script type="text/javascript">
        // const btn = document.getElementById("generarpdf");
        // btn.addEventListener("click", function(e) {
        //     const contentElement = document.getElementById("content");
        //     const elementoAEliminar = document.getElementById("elementoAEliminar");
        //     if (elementoAEliminar) {
        //         elementoAEliminar.innerHTML = '';
        //     }

        //     var options = {
        //         margin: [5, 10],
        //         filename: "resultado del examen.pdf",
        //         pagebreak: {
        //             mode: 'avoid-all'
        //         },
        //     };
        //     html2pdf()
        //         .from(contentElement)
        //         .set(options)
        //         .outputPdf()
        //         .save()
        //         .catch(function(error) {
        //             console.error("Error al generar el PDF: ", error);
        //         });
        // });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = @json($data);
            if (!data) {
                console.error("Element 'data' not found.");
                return;
            }
            data.sort((a, b) => b.buenas_p - a.buenas_p);

            // const primeros5 = data.slice(0, 5);
            // const aprobados = [];
            // const desaprobados = [];
            // let i = 1.5;
            // let j = 1.5;
            // let prevBuenasP = null;
            // data.forEach((user) => {
            //     if (user.buenas_p > 50) {
            //         if (prevBuenasP !== user.buenas_p) {
            //             i = 1.5;  
            //         }
            //         const aprobado = [user.buenas_p, user.buenas, user.name, user.buenas_p];
            //         if (aprobados.length > 0) {
            //             const lastAprobado = aprobados[aprobados.length - 1];
            //             if (aprobado[0] === lastAprobado[0]) {
            //                 aprobado[0] += i;
            //                 i++;
            //             }
            //         }
            //         aprobados.push(aprobado);
            //     } else {
            //         if (prevBuenasP !== user.buenas_p) {
            //             j = 1.5;  
            //         }
            //         const desaprobado = [user.buenas_p, user.buenas, user.name, user.buenas_p];
            //         if (desaprobados.length > 0) {
            //             const lastDesaprobado = desaprobados[desaprobados.length - 1];
            //             if (desaprobado[0] === lastDesaprobado[0]) {
            //                 desaprobado[0] -= j;
            //                 j++;
            //             }
            //         }
            //         desaprobados.push(desaprobado);
            //     }
            // });
            const aprobados = [];
            const desaprobados = [];
            let prevBuenasP = null;
            let i = 3;  
            let j = 3;  

            data.forEach((user) => {
                if (user.buenas_p >= 50) {
                    if (prevBuenasP !== user.buenas_p) {
                        i = 3;  
                    }
                    const aprobado = [user.buenas_p, user.buenas, user.name, user.buenas_p];
                    if (aprobados.length > 0) {
                        const lastAprobado = aprobados[aprobados.length - 1];
                        if (aprobado[0] === lastAprobado[3]) {
                            aprobado[0] += i;
                            i += 3;
                        }
                    }
                    aprobados.push(aprobado);
                } else {
                    if (prevBuenasP !== user.buenas_p) {
                        j = 3; 
                    }
                    const desaprobado = [user.buenas_p, user.buenas, user.name, user.buenas_p];
                    if (desaprobados.length > 0) {
                        const lastDesaprobado = desaprobados[desaprobados.length - 1];
                        console.log(lastDesaprobado);
                        console.log(j);
                        if (desaprobado[0] === lastDesaprobado[3]) {
                            desaprobado[0] -= j;
                            j += 3;
                        }
                    }
                    desaprobados.push(desaprobado);
                }
                prevBuenasP = user.buenas_p;
            });

            function getChartColorsArray(elementId) {
                const element = document.getElementById(elementId);
                if (element) {
                    const dataColors = element.getAttribute("data-colors");
                    const colors = JSON.parse(dataColors);
                    return colors.map((color) => {
                        const trimmedColor = color.replace(" ", "");
                        if (trimmedColor.indexOf(",") === -1) {
                            return getComputedStyle(document.documentElement).getPropertyValue(trimmedColor) || trimmedColor;
                        } else {
                            const colorParts = color.split(",");
                            if (colorParts.length === 2) {
                                return `rgba(${getComputedStyle(document.documentElement).getPropertyValue(colorParts[0])}, ${colorParts[1]})`;
                            } else {
                                return trimmedColor;
                            }
                        }
                    });
                }
            }

            const chartScatterImagesColors = getChartColorsArray("images_scatter");
            if (chartScatterImagesColors) {
                var options = {
                    series: [{
                        name: "Desaprobados",
                        data: desaprobados,
                    }, {
                        name: "Aprobados",
                        data: aprobados,
                    }, ],
                    chart: {
                        height: 350,
                        type: "scatter",
                        animations: {
                            enabled: !1
                        },
                        zoom: {
                            enabled: !1
                        },
                        toolbar: {
                            show: !1
                        },
                    },
                    tooltip: {
                        custom: function({
                            series,
                            seriesIndex,
                            dataPointIndex,
                            w
                        }) {
                            const userData = options.series[seriesIndex].data[dataPointIndex];
                            const estado = options.series[seriesIndex].name;
                            const alumno = userData[2];
                            const porcentajes = userData[3];
                            const acertadas = userData[1];
                            const tooltipContent = ` 
                            <div class="d-flex align-items-center px-3 p-2"> 
                                <div class="flex-grow-1 ">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">  ${alumno} </p>
                                    <p class="text-muted mb-1"><b>${estado}</b></p> 
                                    <p class="text-muted mb-0 fs-12">Acertadas: <b>${acertadas} de ${data[0].cantidad}</b></p> 
                                    <span class="badge badge-soft-info w-100 text-center">${porcentajes}%<span> </span></span>
                                </div> 
                            </div> 
                            `;
                            return tooltipContent;
                        }
                    },
                    colors: chartScatterImagesColors,
                    xaxis: {
                        tickAmount: 5,
                        min: 0,
                        max: 100
                    },
                    yaxis: {
                        tickAmount: 7
                    },
                    markers: {
                        size: 20
                    },
                    fill: {
                        type: "image",
                        opacity: 1,
                        image: {
                            src: [
                                "./assets/images/users/perfil_1.jpg",
                                "./assets/images/users/perfil_2.jpg",
                            ],
                            width: 40,
                            height: 40,
                        },
                    },
                    legend: {
                        labels: {
                            useSeriesColors: !0
                        },
                        markers: {
                            customHTML: [
                                function() {
                                    return "";
                                },
                                function() {
                                    return "";
                                },
                            ],
                        },
                    },
                };
                var chart = new ApexCharts(document.querySelector("#images_scatter"), options);
                chart.render();
            }
        });
    </script>
@endsection
