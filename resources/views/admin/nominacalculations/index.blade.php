@extends('layouts.dashboard')

@section('content')

   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Nómina: {{ $nomina->description }} {{ $nomina->date_begin}}</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('nominacalculations.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar una Nómina</a>
         
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                
                <th>Abreviatura</th>
                <th>Concepto</th>
                <th>Dias</th>
                <th>Horas</th>
                <th>Cantidad</th>
                <th>Asignación</th>
                <th>Deducción</th>
               <th>Opciones</th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($nominacalculations))
                @else
                    @foreach ($nominacalculations as $key => $nominacalculation)
                    <tr>
                    
                    <td></td>
                    <td></td>
                    <td>{{$nominacalculation->days}}</td>
                    <td>{{$nominacalculation->hours}}</td>
                    <td>{{$nominacalculation->cantidad}}</td>
                    <td></td>
                    <td></td>
                   
                    @if (Auth::user()->role_id  == '1')
                        <td>
                            <a href="{{route('nominacalculations.selectemployee',$nominacalculation->id) }}" title="Ver Detalles"><i class="fa fa-binoculars"></i></a>  
                            <a href="{{route('nominacalculations.edit',$nominacalculation->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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
