@extends('admin.layouts.dashboard')

@section('content')


<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link  font-weight-bold" style="color: black;" id="home-tab"  href="{{ route('quotations') }}" role="tab" aria-controls="home" aria-selected="true">Cotizaciones</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link active font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('invoices') }}" role="tab" aria-controls="profile" aria-selected="false">Facturas</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link font-weight-bold" style="color: black;" id="contact-tab"  href="{{ route('quotations.indexdeliverynote') }}" role="tab" aria-controls="contact" aria-selected="false">Notas De Entrega</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('sales') }}" role="tab" aria-controls="profile" aria-selected="false">Ventas</a>
      </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="contact-tab"  href="{{ route('anticipos') }}" role="tab" aria-controls="contact" aria-selected="false">Anticipos Clientes</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="profile-tab"  href="{{ route('clients') }}" role="tab" aria-controls="profile" aria-selected="false">Clientes</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link font-weight-bold" style="color: black;" id="contact-tab"  href="{{ route('vendors') }}" role="tab" aria-controls="contact" aria-selected="false">Vendedores</a>
    </li>
  </ul>




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
                <th class="text-center">Fecha</th>
                <th class="text-center">N??</th>
                <th class="text-center">Cliente</th>
                <th class="text-center">Monto</th>
                <th class="text-center">Iva</th>
                <th class="text-center">Monto Con Iva</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            
            <tbody>
                @if (empty($quotations))
                @else  
                    @foreach ($quotations as $quotation)
                        <tr>
                            <td class="text-center font-weight-bold">{{$quotation->date_billing}}</td>
                            <td class="text-center font-weight-bold">
                                <a href="{{ route('quotations.createfacturado',[$quotation->id,$quotation->coin ?? 'bolivares']) }}" title="Ver Factura" class="font-weight-bold text-dark">{{ $quotation->id }}</a>
                            </td>
                            <td class="text-center font-weight-bold">{{ $quotation->clients['name']}}</td>
                            <td class="text-right font-weight-bold">{{number_format($quotation->amount, 2, ',', '.')}}</td>
                            <td class="text-right font-weight-bold">{{number_format($quotation->amount_iva, 2, ',', '.')}}</td>
                            <td class="text-right font-weight-bold">{{number_format($quotation->amount_with_iva, 2, ',', '.')}}</td>
                            @if ($quotation->status == "C")
                            <td class="text-center font-weight-bold">
                                <a href="{{ route('quotations.createfacturado',[$quotation->id,$quotation->coin ?? 'bolivares']) }}" title="Ver Factura" class="text-center text-success font-weight-bold">Cobrado</a>
                            </td>
                            @else
                            <td class="text-center font-weight-bold">
                                <a href="{{ route('quotations.createfacturar_after',[$quotation->id,$quotation->coin ?? 'bolivares']) }}" title="Cobrar Factura" class="font-weight-bold text-dark">Click para Cobrar</a>
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
        "ordering": false,
        "order": [],
            'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]]
    } );

        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    </script>
@endsection
