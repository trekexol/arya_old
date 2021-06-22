@extends('admin.layouts.dashboard')

@section('content')


<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-sm-8">
            <h2>Listado de Comprobantes Contables detallados de la cuenta: Nº {{ $account->code_one }}.{{ $account->code_two }}.{{ $account->code_three }}.{{ $account->code_four }} / {{ $account->description }}</h2>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('accounts') }}" class="btn btn-light2"><i class="fas fa-eye" ></i>
                &nbsp Plan de Cuentas
            </a>
        </div>
       
    </div>
    <!-- Page Heading -->
   
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
                <th>Fecha</th>
                <th>Tipo de Movimiento</th>
                
                <th>Referencia</th>
              
                <th>Descripción</th>
                <th>Debe</th>
                <th>Haber</th>
               
               
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($detailvouchers))
                @else
                    @foreach ($detailvouchers as $var)
                    <tr>
                    <td>{{$var->headers['date'] ?? $var->banks['date'] ?? ''}}</td>

                    @if(isset($var->id_bank_voucher))
                        <td>Bancario</td>
                        <a href="{{ route('accounts.header_movements',[$var->id_bank_voucher,'bank']) }}" title="Crear">{{ $var->id_bank_voucher }}</a>
                    @elseif(isset($var->id_invoice))
                        <td>Factura</td>
                        <a href="{{ route('accounts.header_movements',[$var->id_invoice,'invoice']) }}" title="Crear">{{ $var->id_invoice }}</a>
                    @elseif(isset($var->id_expense))
                        <td>Gasto o Compra</td>
                        <a href="{{ route('accounts.header_movements',[$var->id_expense,'expense']) }}" title="Crear">{{ $var->id_expense }}</a>
                    @elseif(isset($var->id_header_voucher)) 
                        <td>Otro</td>
                        <a href="{{ route('accounts.header_movements',[$var->id_header_voucher,'header_voucher']) }}" title="Crear">{{ $var->id_header_voucher }}</a>
                    @endif
                    

                    <td>{{$var->id_header_voucher ?? $var->id_bank_voucher ?? $var->id_invoice ?? $var->id_expense ?? ''}}</td>
                                   
                    @if(isset($var->id_bank_voucher))
                      
                        <td>{{$var->banks['description'] ?? ''}}</td>
                    @elseif (isset($var->id_invoice))
                        
                        <td>{{$var->headers['description'] ?? ''}} fact({{ $var->id_invoice }}) / {{$var->accounts['description'] ?? ''}}</td>
                    
                    @elseif (isset($var->id_expense))
                        
                        <td>{{$var->headers['description'] ?? ''}} Compra({{ $var->id_expense }}) / {{$var->accounts['description'] ?? ''}}</td>
                    @else
                        
                        <td>{{$var->headers['description'] ?? ''}}</td>
                    @endif
                   
                    <td>{{$var->debe}}</td>
                    <td>{{$var->haber}}</td>

                 
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