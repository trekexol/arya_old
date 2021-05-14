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
    <div class="col-md-1">
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
                <div class="card-header" style="text-align: center">Listado de Movimientos de Caja y Bancos</div>

                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                                <th>Fecha del Movimiento</th>
                                <th>Caja / Banco</th>
                                <th>Tipo Mov.</th>	
                                <th>Referencia</th>	
                                <th>Descripción</th>
                                
                                <th>Monto</th>
                            
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @if (empty($bankmovements))
                                @else  
                                <?php
                                    $intercalar = true;
                                    $total = 0;
                                ?>
                            
                                    @foreach ($bankmovements as $var)
                                        <tr>
                                        @if($intercalar)
                                        <?php 
                                            $intercalar = false;
                                            $total += $var->amount;
                                        ?>

                                            <td style="text-align:right; color:black;">{{$var->date}}</td>
                                            <td style="text-align:right; color:black;">{{ $var->accounts['description']}}</td>
                                            
                                            <td style="text-align:right; color:black;">{{$var->type_movement}}</td>
                                            <td style="text-align:right; color:black;">{{$var->reference}}</td>
                                            <td style="text-align:right; color:black;">{{$var->description}}</td>
                                            <td style="text-align:right; color:black;">{{number_format($var->amount, 2, ',', '.')}}</td>
                                                            
                                        
                                            <td style="text-align:right; color:black;">  
                                                <a href="{{ route('bankmovements.createdeposit',$var->id) }}" title="Depositar"><i class="fa fa-download"></i></a>
                                         </td>
                                        </tr>   

                                        @else
                                            <?php 
                                                $intercalar = true; 
                                                $total += $var->amount;
                                            ?>

                                            <td style="text-align:right; color:black;">{{$var->date}}</td>
                                            <td style="text-align:right; color:black;">{{ $var->accounts['description']}}</td>
                                            
                                            <td style="text-align:right; color:black;">{{$var->type_movement}}</td>
                                            <td style="text-align:right; color:black;">{{$var->reference}}</td>
                                            <td style="text-align:right; color:black;">{{$var->description}}</td>
                                            <td style="text-align:right; color:black;">{{number_format($var->amount, 2, ',', '.')}}</td>
                                                            

                                            <td style="text-align:right; color:black;">  
                                                <a href="{{ route('bankmovements.createdeposit',$var->id) }}" title="Depositar"><i class="fa fa-download"></i></a>
                                            </td>
                                        </tr>   
                                        @endif  
                                        
                                    @endforeach   
                                    <tr>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">-----------</td>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">-----------</td>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">------</td>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">-----------</td>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">Totales</td>
                                        <td style="background: #E0D7CD; text-align:right; color:black;">{{number_format($total, 2, ',', '.')}}</td>
                                        
                                        <td style="background: #E0D7CD; text-align:right; color:black;"></td>
                                    
                                        </tr>
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
        "order": []
    });
    </script> 
@endsection