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
                <th>Fecha</th>
                <th>Nº</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Iva</th>
                <th>Monto Con Iva</th>
                <th></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($quotations))
                @else  
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td>{{$quotation->date_billing}}</td>
                            <td class="text-center">
                                <a href="{{ route('quotations.createfacturado',$quotation->id) }}" title="Ver Factura" class="font-weight-bold text-dark">{{ $quotation->id }}</a>
                            </td>
                            <td>{{ $quotation->clients['name']}}</td>
                            <td class="text-right">{{ $quotation->amount}}</td>
                            <td class="text-right">{{ $quotation->amount_iva}}</td>
                            <td class="text-right">{{ $quotation->amount_with_iva}}</td>
                            @if ($quotation->status == "C")
                                <td class="text-center text-success font-weight-bold">Cobrado</td>
                            @else
                            <td class="text-center">
                                <a href="{{ route('quotations.createfacturar',$quotation->id) }}" title="Ver Factura" class="font-weight-bold text-dark">Click para Cobrar</a>
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
    $('#dataTable').dataTable( {
  "ordering": false
} );
</script>
    
@endsection
