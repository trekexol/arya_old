@extends('layouts.dashboard')

@section('content')


<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-8">
            <h2>Listado de Comprobantes Contables detallados de la cuenta: Nº {{ $account->code_one }}.{{ $account->code_two }}.{{ $account->code_three }}.{{ $account->code_four }} / {{ $account->description }}</h2>
        </div>
        <div class="col-md-2">
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
                <th>Cuenta</th>
                <th>Referencia</th>
                <th>Factura</th>
                <th>Descripción</th>
                <th>Debe</th>
                <th>Haber</th>
               
               
              
            </tr>
            </thead>
            
            <tbody>
                @if (empty($detailvouchers))
                @else
                    @foreach ($detailvouchers as $key => $var)
                    <tr>
                    <td>{{$var->headers['date']}}</td>
                    <td>{{$var->accounts['code_one']}}.{{$var->accounts['code_two']}}.{{$var->accounts['code_three']}}.{{$var->accounts['code_four']}}</td>
                    <td>{{$var->id_header_voucher}}</td>
                  
                    @if (isset($var->id_invoice))

                    <td>{{$var->id_invoice}}</td>
                    <td>{{$var->headers['description']}} fact({{ $var->id_invoice }}) / {{$var->accounts['description']}}</td>

                    @else
                    <td></td>
                    <td>{{$var->headers['description']}}</td>

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
        "order": []
    });
    </script> 
@endsection