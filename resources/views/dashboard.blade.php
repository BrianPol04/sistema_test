@extends('admin.layouts.app')
@section('styles')
    <style>
        .widget-box {
            padding: 20px;
            border: 1px solid #e3e6f0;
            border-radius: 10px;
            background-color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #clock {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 48px;
            font-weight: bold;
            letter-spacing: 2px;
            margin-top: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #clock span {
            display: inline-block;
            padding: 0 10px;
        }

        #clock .ampm {
            font-size: 24px;
            vertical-align: top;
            margin-left: 10px;
        }

        #calendar {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 20px;
            box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #calendar #currentDate {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Reloj en tiempo real -->
        <div class="col-lg-4 col-md-6">
            <div class="widget-box">
                <h5>Reloj</h5>
                <div id="clock"></div>
            </div>
        </div>

        <!-- Calendario -->
        <div class="col-lg-4 col-md-6">
            <div class="widget-box">
                <h5>Calendario</h5>
                <div id="calendar">
                    <div id="currentDate"></div>
                </div>
            </div>
        </div>

        <!-- Clima -->

    </div>
@endsection

@section('scripts')
    <script>
        // Reloj en tiempo real con estilo
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // La hora '0' debe ser '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            seconds = seconds < 10 ? '0'+seconds : seconds;
            var timeString = '<span>' + hours + '</span>:<span>' + minutes + '</span>:<span>' + seconds + '</span>' +
                             '<span class="ampm">' + ampm + '</span>';
            document.getElementById('clock').innerHTML = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock(); // Inicializa el reloj

        // Calendario simple con estilo visual
        function renderCalendar() {
            var now = new Date();
            var days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            var dayName = days[now.getDay()];
            var monthName = months[now.getMonth()];
            var day = now.getDate();
            var year = now.getFullYear();
            var calendarString = dayName + ', ' + day + ' de ' + monthName + ' de ' + year;
            document.getElementById('currentDate').innerHTML = calendarString;
        }
        renderCalendar();
//156
        // Widget de clima (usando OpenWeatherMap API)

    </script>
@endsection

