@extends('layouts.dashboard')

@section('content')

   

   

  {{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}

<!-- container-fluid -->
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Seleccione un Comprobante Cabecera</h6>
    </div>
   
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Referencia</th>
                <th>Descripción</th>
                
                <th>Opciones</th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($headervouchers))
                @else
                    @foreach ($headervouchers as $key => $var)
                    <tr>
                    <td>{{$var->date}}</td>
                    <td><a href="{{route('detailvouchers.createselect',$var->id) }}" title="Seleccionar">{{$var->reference}}</a></td>
                    <td>{{$var->description}}</td>
                    
                   
                        <td>
                        <a href="{{route('detailvouchers.createselect',$var->id) }}" title="Seleccionar"><i class="fa fa-check"></i></a>  
                        </td>
                   
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>

@endsection
