@extends('layouts.dashboard')

@section('content')

   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Nóminas Registradas</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('nominas.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar una Nómina</a>
         
        </div>
        @endif
       
            
       
    </div>

  </div>

  {{-- VALIDACIONES-RESPUESTA--}}
@include('admin.layouts.success')   {{-- SAVE --}}
@include('admin.layouts.danger')    {{-- EDITAR --}}
@include('admin.layouts.delete')    {{-- DELELTE --}}
{{-- VALIDACIONES-RESPUESTA --}}

<div class="card shadow mb-4">
   
   
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                
                <th>Descripción</th>
                <th>Tipo de Nómina</th>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Tipo de Empleado</th>
               <th>Opciones</th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($nominas))
                @else
                    @foreach ($nominas as $key => $nomina)
                    <tr>
                    
                    <td>{{$nomina->description}}</td>
                    <td>{{$nomina->type}}</td>
                    <td>{{$nomina->date_begin}}</td>
                    <td>{{$nomina->date_end}}</td>
                    <td>{{$nomina->professions['name']}}</td>
                   
                    @if (Auth::user()->role_id  == '1')
                        <td>
                            <a href="{{route('nominas.selectemployee',$nomina->id) }}" title="Ver Detalles"><i class="fa fa-binoculars"></i></a>  
                            <a href="{{route('nominas.edit',$nomina->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
                        </td>
                    @endif
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>


@endsection
