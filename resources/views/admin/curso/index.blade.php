@extends('admin.layouts.app')
@section('styles')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ">DATOS DEL CURSO:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario" action="{{ route('curso.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                            @if ($errors->any())
                                <script>
                                    $(document).ready(function() {
                                        $('#exampleModal').modal('show');
                                        $('#password-input').removeAttr('required');
                                        $('#opcional').html(' opcional');
                                    });
                                </script>
                            @endif
                            <div class="col-12 mb-2">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control " id="nombre" placeholder="escribe..." maxlength="255" required name="nombre">
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="col-xl-6">
                                <div class=" mt-4">
                                    <h5 class="fs-14">Colors :</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        <label for="primary" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-primary  bg-primary">
                                            <input type="radio" name="color" id="primary" value="primary" class="d-none" onchange="changeColor(this)" checked>
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        <label for="secondary" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-secondary">
                                            <input type="radio" name="color" id="secondary" value="secondary" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        <label for="success"class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-success">
                                            <input type="radio" name="color" id="success" value="success" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        <label for="info" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-info">
                                            <input type="radio" name="color" id="info" value="info" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        <label for="warning" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-warning">
                                            <input type="radio" name="color" id="warning" value="warning" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        <label for="danger" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-danger">
                                            <input type="radio" name="color" id="danger" value="danger" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                        
                                        <label for="dark" class="color-select avatar-xs p-0 d-flex align-items-center justify-content-center border rounded-circle fs-20 text-dark">
                                            <input type="radio" name="color" id="dark" value="dark" class="d-none" onchange="changeColor(this)">
                                            <i class="ri-checkbox-blank-circle-fill"></i>
                                        </label>
                                    </div>
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
                <h4 class="mb-sm-0">cursos</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">cursos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Lista de cursos</h4>
                    <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                        <div class="form-group mx-3">
                            <button type="button" class="btn btn-primary" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#exampleModal"> Nuevo curso    </button>
                        </div>
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($data as $item)
                            <div class="col-xl-6 col-md-6 col-sm-12">
                                <div class="card {{ 'card-' . $item->color }} pb-0"> 
                                    <div class="card-body p-0 ">
                                        <div class="alert border-0 rounded-top rounded-0 m-0 d-flex align-items-center  shadow-lg"   role="alert">
                                            <i class="avatar-title rounded-circle bg-soft-light text-light me-2 icon-sm"> <i class="ri-bookmark-fill"></i></i>
                                            <div class="flex-grow-1 text-truncate text-uppercase"> <b>{{ $item->nombre }}</b> </div>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown float-end">
                                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-light fs-18"><i class="mdi mdi-dots-vertical"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item cursor-pointer" onclick="Editar({{ json_encode($item) }})"> <i class="ri-file-edit-line"></i> Editar</a>
                                                        <a class="dropdown-item" href="{{ route('curso.delete', $item->id) }}"> <i class="ri-delete-bin-2-line"></i> Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cursor-pointer" onclick="window.location.href = '{{ url('temas?cod=') . base64_encode($item->id) }}';">
                                            <div class="p-2 pb-0" style="height: 100px">
                                                <p class="fs-16 lh-base">{{ $item->descripcion }} </p>
                                            </div>
                                            <div class="col-sm-4 float-end">
                                                <div class="px-3 ">
                                                    <img src="assets/images/user-illustarator-2.png" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </div>
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
        function Nuevo() {
            $('#id').val(0);
            $("#miFormulario")[0].reset();
            $('#password-input').attr('required');
            $('#opcional').html('');
            reset_clor();
            let selectedLabel = $('label[for="primary"]');
                    selectedLabel.addClass('bg-primary');
        }

        function Editar(data) {
            Object.keys(data).forEach(function(key) {
                let value = data[key];
                if (key == 'color') {
                    $('#' + value).prop('checked', true); 
                    reset_clor();
                    let selectedLabel = $('label[for="' + value + '"]');
                    selectedLabel.addClass('bg-'+value);
                } else {
                    $('#' + key).val(value);
                }
            });
            $('#password-input').removeAttr('required');
            $('#opcional').html(' opcional');
            $('#exampleModal').modal('show');
        } 
        function changeColor(radio) {
            reset_clor();
            radio.parentElement.classList.add('bg-' + radio.value);
        }
        function reset_clor() {
            var colorSelects = document.querySelectorAll('.color-select');
            colorSelects.forEach(function(element) {
                element.classList.remove(element.classList.value.match(/\bbg-\w+/));
            }); 
        }
    </script>
@endsection
