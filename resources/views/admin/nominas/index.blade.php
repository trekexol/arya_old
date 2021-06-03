@extends('layouts.dashboard')

@section('content')

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link active font-weight-bold" style="color: black;" id="home-tab"  href="{{ route('nominas') }}" role="tab" aria-controls="home" aria-selected="true">Nóminas</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('nominaconcepts') }}" role="tab" aria-controls="profile" aria-selected="false">Concepto de Nómina</a>
        </li>
    </ul>
   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Nóminas Registradas</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('nominas.create')}}" class="btn btn-primary float-md-right" role="button" aria-pressed="true">Registrar una Nómina</a>
         
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
                
                <th class="text-center">Descripción</th>
                <th class="text-center">Tipo de Nómina</th>
                <th class="text-center">Desde</th>
                <th class="text-center">Hasta</th>
                <th class="text-center">Tipo de Empleado</th>
               <th class="text-center"></th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($nominas))
                @else
                    @foreach ($nominas as $key => $nomina)
                    <tr>
                    
                    <td class="text-center">{{$nomina->description}}</td>
                    <td class="text-center">{{$nomina->type}}</td>
                    <td class="text-center">{{$nomina->date_begin}}</td>
                    <td class="text-center">{{$nomina->date_end}}</td>
                    <td class="text-center">{{$nomina->professions['name']}}</td>
                   
                    @if (Auth::user()->role_id  == '1')
                        <td class="text-center">
                            <a href="{{route('nominas.calculate',$nomina->id) }}" title="Calcular Nomina"><i class="fa fa-calculator"></i></a>  
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
@section('javascript')
    <script>
    $('#dataTable').DataTable({
        "ordering": false,
        "order": [],
        'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]],
        'iDisplayLength': '50'
    });
    </script> 
@endsection