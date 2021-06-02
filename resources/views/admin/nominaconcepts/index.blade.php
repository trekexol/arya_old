@extends('layouts.dashboard')

@section('content')

    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link  font-weight-bold" style="color: black;" id="home-tab"  href="{{ route('nominas') }}" role="tab" aria-controls="home" aria-selected="true">Nóminas</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link active font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('nominaconcepts') }}" role="tab" aria-controls="profile" aria-selected="false">Concepto de Nómina</a>
        </li>
    </ul>

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Conceptos de Nóminas Registradas</h2>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-6">
            <a href="{{ route('nominaconcepts.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar un Concepto de Nómina</a>
         
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
                <th>Abreviatura</th>
                <th>Descripción</th>
                <th>Signo</th>
                <th>Tipo de Nómina</th>
                <th>Fórmula Mensual</th>
                <th>Fórmula Semanal</th>
                <th>Fórmula Quincenal</th>
                <th>Calcular Nómina</th>
               <th>Opciones</th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($nominaconcepts))
                @else
                    @foreach ($nominaconcepts as $key => $nominaconcept)
                    <tr>

                    <td>{{$nominaconcept->abbreviation}}</td>
                    <td>{{$nominaconcept->description}}</td>
                    @if($nominaconcept->sign == "A")
                        <td>Asignación</td>
                    @else
                        <td>Deducción</td>
                    @endif
                    
                    <td>{{$nominaconcept->type}}</td>
                    <td>{{$nominaconcept->formula_m}}</td>
                    <td>{{$nominaconcept->formula_s}}</td>
                    <td>{{$nominaconcept->formula_q}}</td>
                   
                    @if($nominaconcept->calculate == "S")
                        <td>Si</td>
                    @else
                        <td>No</td>
                    @endif
                    @if (Auth::user()->role_id  == '1')
                        <td>
                            <a href="{{route('nominaconcepts.edit',$nominaconcept->id) }}" title="Editar"><i class="fa fa-edit"></i></a>  
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
