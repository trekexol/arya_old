@extends('layouts.dashboard')

@section('content')

   

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-4">
            <h2>Anticipos de Clientes</h2>
        </div>
        <div class="col-md-2">
            <a href="{{ route('anticipos')}}" class="btn btn-info btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-hand-holding-usd"></i>
                </span>
                <span class="text">Anticipos</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('anticipos.historic')}}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-book"></i>
                </span>
                <span class="text">Ver Historico de Anticipos</span>
            </a>
        </div>
       
        @if (Auth::user()->role_id  == '1' || Auth::user()->role_id  == '2' )
        <div class="col-md-3">
            <a href="{{ route('anticipos.create')}}" class="btn btn-primary" role="button" aria-pressed="true">Registrar un Anticipo</a>
         
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
                <th>Cliente</th>
                <th>Caja/Banco</th>
                <th>Fecha del Anticipo</th>
                <th>Referencia</th>
                <th>Monto</th>
               <th></th>
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($anticipos))
                @else
                    @foreach ($anticipos as $key => $anticipo)
                    <tr>
                    <td>{{$anticipo->clients['name']}}</td>
                    <td>{{$anticipo->accounts['description']}}</td>
                    <td>{{$anticipo->date}}</td>
                    <td>{{$anticipo->reference}}</td>
                    <td style="text-align: right">{{number_format($anticipo->amount, 2, ',', '.')}}</td>
                   
                    @if (Auth::user()->role_id  == '1')
                        <td>
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
