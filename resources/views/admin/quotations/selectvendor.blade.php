@extends('layouts.dashboard')

@section('content')


  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Seleccionar Vendedor</h6>
    </div>
    <div class="card-body">
        <div class="container">
            @if (session('flash'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('flash')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times; </span>
                </button>
            </div>   
        @endif
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr> 
                <th>Seleccionar</th>
                <th>Parroquia</th>
                <th>Comisión</th>
                <th>Empleado</th>
                <th>Usuario</th>
                <th>Código</th>
                <th>Cédula o Rif</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Teléfono 2</th>
                <th>Comisión</th>
                <th>Instagram</th>
                <th>Facebook</th>
                <th>Twitter</th>
                <th>Especificación</th>
                <th>Observación</th>
               
            </tr>
            </thead>
            
            <tbody>
                @if (empty($vendors))
                @else  
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>
                                <a href="{{ route('quotations.createquotationvendor',[$id_client ?? '-1',$vendor->id ?? '-1']) }}"  title="Editar"><i class="fa fa-check"></i></a>
                            </td>
                            <td>{{$vendor->parroquias['descripcion']}}</td>
                            <td>{{$vendor->comisions['description']}}</td>
                            <td>{{$vendor->employees['nombres']}}</td>
                            <td>{{$vendor->users['name']}}</td>
                            <td>{{$vendor->code}}</td>
                            <td>{{$vendor->cedula_rif}}</td>
                            <td>{{$vendor->name}}</td>
                            <td>{{$vendor->surname}}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{$vendor->phone}}</td>
                            <td>{{$vendor->phone2}}</td>
                            <td>{{$vendor->comision}}</td>
                            <td>{{$vendor->instagram}}</td>
                            <td>{{$vendor->facebook}}</td>
                            <td>{{$vendor->twitter}}</td>
                            <td>{{$vendor->especification}}</td>
                            <td>{{$vendor->observation}}</td>
                           
                           
                        </tr>     
                    @endforeach   
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
  
@endsection
