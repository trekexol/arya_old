@extends('admin.layouts.dashboard')

@section('content')


<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-6">
            <h2>Listado de Comprobantes Contables detallados</h2>
        </div>
        <div class="col-md-3">
            <a href="{{ route('accounts') }}" class="btn btn-light2"><i class="fas fa-eye" ></i>
                 Plan de Cuentas
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('expensesandpurchases.create_expense_voucher',[$expense->id,$coin]) }}" class="btn btn-light2"><i class="fas fa-undo" ></i>
                 Volver a la Compra
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
                    
                    <td>{{$var->headers['description']}} Compra({{ $var->id_expense }}) / {{$var->accounts['description']}}</td>

                    @if ($coin == 'bolivares')
                        <td class="text-right">{{number_format($var->debe, 2, ',', '.')}}</td>
                        <td class="text-right">{{number_format($var->haber, 2, ',', '.')}}</td>
                    @else
                        <td class="text-right">{{number_format($var->debe / $var->tasa ?? 1, 2, ',', '.')}}</td>
                        <td class="text-right">{{number_format($var->haber / $var->tasa ?? 1, 2, ',', '.')}}</td>
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
        'aLengthMenu': [[50, 100, 150, -1], [50, 100, 150, "All"]]
    });

    $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    </script> 

@endsection