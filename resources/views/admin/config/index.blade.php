@extends('admin.layouts.app')
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Configuración</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Configuración</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-center  aling-items-center">
            <div class="col-6 ">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Configuración</h4>
                        <div class="flex-shrink-0 d-flex justify-content-between align-items-center">

                        </div>
                    </div>
                    <div class="card-body">
                        <form id="miFormulario" action="{{ route('cofiguracion.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                <div class="col-12  mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" placeholder="escribe..." maxlength="255" required name="nombre" value="{{ $data->nombre }}">
                                </div>
                                <div class="col-12  mb-3">
                                    <label for="logo" class="form-label">logo</label>
                                    <input type="file" class="form-control"  name="logo">
                                </div>
                                <div class="col-12  mb-3 "> 
                                    <div class="bg-primary w-25 p-3 rounded-pill">
                                        <span class="logo-lg">
                                            <img src="{{ $data->logo_light }}" alt="" height="17">
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="logo" class="form-label">logo sm</label>
                                    <input type="file" class="form-control"  name="logo_sm">
                                </div>
                                <div class="col-12  mb-3 "> 
                                    <div class="bg-primary w-25 p-3 rounded-pill">
                                        <span class="logo-lg">
                                            <img src="{{ $data->logo_sm}}" alt="" height="17">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Guardar los cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
