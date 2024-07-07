@extends('admin.layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card crm-widget">
                <div class="card-body p-0">
                    <div class="row row-cols-xxl-5 row-cols-md-3 row-cols-1 g-0">
                        <div class="col">
                            <div class="py-4 px-3">
                                <h5 class="text-primary text-uppercase fs-13">Alumnos<i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class=" bx  bxs-user-badge display-6 text-success "></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value text-success" data-target="{{ $alumno }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-primary text-uppercase fs-13">Profesores <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bxs-user-account display-6 text-info"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value text-info" data-target="{{ $profesores }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mt-md-0 py-4 px-3">
                                <h5 class="text-primary text-uppercase fs-13">Usuarios <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-user display-6 text-primary"></i>
                                    </div>

                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value text-primary" data-target="{{ $admin }}">0</span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                <h5 class="text-primary text-uppercase fs-13">Cursos <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-book display-6 text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value text-warning" data-target="{{ $curso }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                <h5 class="text-primary text-uppercase fs-13">Examenes <i class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                                </h5>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="bx bx-file display-6 text-danger"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h2 class="mb-0"><span class="counter-value text-danger" data-target="{{ $examenes }}">0</span></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <p class="text-uppercase text-primary">Resultado del último Examen</p>
                </div>
                <div class="card-body">
                    <div id="images_scatter" data-colors='["--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
        <div class="col-md-5  ">
            <div class="card">
                <div class="card-body mt-1">
                    <div class="profile-foreground position-relative mx-n4 mt-n4">
                        <div class="p-wid-bg  "  >
                            <img src="assets/images/profile-bg.jpg" alt="" class="p-wid-img" />
                        </div>
                    </div>
                    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                        <div class="row g-4">
                           
                            <div class="col">
                                <div class="p-2">
                                    <h3 class="text-white mb-1">{{ $config_sis->nombre }}</h3>
                                    <p class="text-white-75">sistema de test</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = @json($data);
            if (!data) {
                console.error("Element 'data' not found.");
                return;
            }
            data.sort((a, b) => b.buenas_p - a.buenas_p);
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
