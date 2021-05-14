@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Facturas</h2>
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
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0" >
            <thead>
            <tr> 
                <th><i class="fas fa-cog"></i></th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Transporte</th>
                <th>Fecha de Cotización</th>
                <th>Fecha de Facturación</th>
                <th>Dias de Crédito</th>
                <th>Moneda</th>
                <th>Costo</th>
               
               
                <th></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($quotations))
                @else  
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td >
                            <a href="{{ route('quotations.createfacturado',$quotation->id) }}" title="Editar"><i class="fa fa-check"></i></a>
                            </td>
                            <td>{{ $quotation->clients['name']}}</td>
                            <td>{{ $quotation->vendors['name']}}</td>
                            <td>{{ $quotation->transports['placa']}}</td>
                            <td>{{$quotation->date_quotation}}</td>
                            <td>{{$quotation->date_billing}}</td>
                            <td>{{$quotation->credit_days}}</td>
                            <td>{{$quotation->coin}}</td>
                            <td>{{$quotation->cost}}</td>
                           
                            <td>
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
