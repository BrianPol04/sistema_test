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
                    <h5 class="modal-title ">DATOS  DEL TEMA:</h5> 
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="miFormulario"  action="{{route('temas.create')}}" method="post" enctype="multipart/form-data"> 
                    @csrf 
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id"  value="{{ old('id') }}">
                            <input type="hidden" name="curso_id" id="curso_id"  value="{{ $id_curso}}">
                            @if ($errors->any())  
                                <script>
                                    $(document).ready(function() {
                                        $('#exampleModal').modal('show');
                                        $('#password-input').removeAttr('required'); 
                                        $('#opcional').html(' opcional'); 
                                    });
                                </script>
                            @endif
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control  " id="nombre" placeholder="escribe..." maxlength="255"   required name="nombre"> 
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
    <div class="container-fluid">  
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">temas</h4> 
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Inicio</a></li>
                            <li class="breadcrumb-item active">temas</li>
                        </ol>
                    </div> 
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Lista de temas</h4>
                        <div class="flex-shrink-0 d-flex justify-content-between align-items-center">
                            <div class="form-group mx-3" >
                                <button type="button" class="btn btn-primary" onclick="Nuevo();" data-bs-toggle="modal" data-bs-target="#exampleModal">  Nueva tema
                                </button>
                            </div>
                            <div class="form-check form-switch form-switch-right form-switch-md"> 
                                <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                            </div>
                        </div>
                    </div> 
                    <div class="card-body">   
                        <div class="live-preview">
                            <table id="alternative-pagination"
                                class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th style="width:50%">Nombre</th>  
                                        <th style="width:40%">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($data as $row) 
                                        <tr ondblclick="window.location.href = '{{ url('preguntas?cod=') . base64_encode($row->id) }}';" class="cursor-pointer">
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->nombre}}</td>    
                                            <td>
                                                <a class="btn btn-sm btn-soft-info" onclick="Editar({{$row}})" >Editar</a> 
                                                <a href="{{route('temas.delete',$row->id)}}" class="btn btn-sm btn-soft-danger">Eliminar</a>
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
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{asset('assets/js/pages/password-addon.init.js')}}"></script>
    <script> 
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
            $('#exampleModal').modal('show');
        }
       
    </script>
 
@endsection 