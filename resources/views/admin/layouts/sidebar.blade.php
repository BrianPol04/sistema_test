<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="25">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="34">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ $config_sis->logo_sm }}" alt="" height="25">
            </span>
            <span class="logo-lg">
                <img src="{{ $config_sis->logo_light }}" alt="" height="34">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('home') }}">
                        <i class="bx bx-home"></i> <span data-key="t-Dashboard">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->rol === 'Admin')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('usuario') }}">
                            <i class="bx bx-user"></i> <span data-key="t-Usuarios">Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('profesores') }}">
                            <i class="bx bxs-user-account"></i> <span data-key="t-Profesores">Profesores</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->rol !== 'Alumno')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('alumnos') }}">
                            <i class="bx  bxs-user-badge"></i> <span data-key="t-Alumnos">Alumnos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('cursos') }}">
                            <i class="bx bx-book"></i> <span data-key="t-Cursos">Gestionar Cursos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('examennew') }}">
                            <i class="bx bx-file"></i> <span data-key="t-Examen">Crear Examen</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('reportexamen') }}">
                            <i class="bx bx-bar-chart"></i> <span data-key="t-Resultado">Resultado de los examenes</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->rol === 'Admin')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('listalumnos') }}">
                            <i class="bx bxs-user-detail"></i> <span data-key="t-listalumnos">Reporte por alumno</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('cofiguracion') }}">
                            <i class="bx bx-cog"></i> <span data-key="t-Cofiguración">Cofiguración</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->rol === 'Alumno')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ url('curso') }}">
                            <i class="bx bx-book-open"></i> <span data-key="t-Cursos">Cursos</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
