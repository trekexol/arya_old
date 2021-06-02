@extends('layouts.dashboard')

@section('content')


  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
<!-- DataTales Example -->
<div class="row justify-content-left">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <a href="{{ route('bankmovements') }}" class="btn btn-info" title="Transferencia">Bancos</a>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center font-weight-bold h3">Listado de Movimientos de Caja y Bancos</div>

                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Referencia</th>
                                    <th class="text-center">Cuenta</th>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Debe</th>
                                    <th class="text-center">Haber</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    @if (empty($detailvouchers))
                                    @else
                                        @foreach ($detailvouchers as $var)
                                        <tr>
                                        <td>{{$var->banks['date'] ?? ''}}</td>
                    
                                        
                                        
                                        <td>{{$var->id_bank_voucher ?? ''}}</td>

                                        <td>{{ $var->accounts['description'] }} / {{$var->accounts['code_one']}}.{{$var->accounts['code_two']  }}.{{ $var->accounts['code_three'] }}.{{ $var->accounts['code_four'] }}</td>
                    
                                        @if ($var->banks['type_movement'] == "RE")
                                            <td>Retiro</td>
                                        @elseif($var->banks['type_movement'] == "DE")
                                            <td>Depósito</td>
                                        @else
                                            <td>Transferencia</td>
                                        @endif
                                        

                                        @if(isset($var->id_bank_voucher))
                                          
                                            <td>{{$var->banks['description'] ?? ''}}</td>
                                        @elseif (isset($var->id_invoice))
                                            
                                            <td>{{$var->headers['description'] ?? ''}} fact({{ $var->id_invoice }}) / {{$var->accounts['description'] ?? ''}}</td>
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
</div>
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