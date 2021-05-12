@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Notas de Entrega</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('quotations.createquotation')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar una Cotización</a>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
<!-- DataTales Example -->
<div class="card shadow mb-4">
    
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
            <thead>
            <tr> 
                <th></th>
                <th>N° de Control/Serie</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Transporte</th>
                <th>Fecha de Cotización</th>
                <th>Fecha de la Nota de Entrega</th>
               
            </tr>
            </thead>
            
            <tbody>
                @if (empty($quotations))
                @else  
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td >
                                
                            <a href="{{ route('quotations.create',$quotation->id) }}" title="Seleccionar"><i class="fa fa-check"></i></a>
                            </td>
                            <td>{{$quotation->serie}}</td>
                            <td>{{ $quotation->clients['name']}}</td>
                            <td>{{ $quotation->vendors['name']}}</td>
                            <td>{{ $quotation->transports['placa']}}</td>
                            <td>{{$quotation->date_quotation}}</td>
                            <td>{{$quotation->date_delivery_note}}</td>
                        </tr>     
                    @endforeach   
                @endif
            </tbody>
        </table>
        </div>
    </div>
</div>
  
@endsection
