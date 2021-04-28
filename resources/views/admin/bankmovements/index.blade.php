@extends('layouts.dashboard')

@section('content')


  <!-- /.container-fluid -->
  {{-- VALIDACIONES-RESPUESTA--}}
  @include('admin.layouts.success')   {{-- SAVE --}}
  @include('admin.layouts.danger')    {{-- EDITAR --}}
  @include('admin.layouts.delete')    {{-- DELELTE --}}
  {{-- VALIDACIONES-RESPUESTA --}}
<!-- DataTales Example -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="text-align: center">Consulta de Caja Y Bancos</div>

                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr> 
                            
                                <th>Descripción</th>
                                
                                <th>Saldo Actual</th>
                            
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @if (empty($accounts))
                                @else  
                                <?php
                                    $intercalar = true;
                                    $total = 0;
                                ?>
                            
                                    @foreach ($accounts as $var)
                                        <tr>
                                        @if($intercalar)
                                        <?php 
                                            $intercalar = false;
                                            $total += $var->debe;
                                        ?>
                                            <td style="text-align:right; color:black;">{{$var->description}}</td>
                                        
                                            <td style="text-align:right; color:black;">{{number_format($var->debe, 2, ',', '.')}}</td>
                                                            
                                        
                                            <td style="text-align:right; color:black;">  
                                                <a href="{{ route('bankmovements.createdeposit',$var->id) }}" title="Depositar"><i class="fa fa-download"></i></a>
                                                <a href="{{ route('bankmovements.createretirement',$var->id) }}" title="Retiro"><i class="fa fa-upload"></i></a>
                                                <a href="bankmovements/register/{{$var->code_one}}/{{$var->code_two}}/{{$var->code_three}}/{{$var->code_four}}/{{$var->period}}" title="Transferencia"><i class="fa fa-exchange-alt"></i></a>
                                          </td>
                                        </tr>   

                                        @else
                                            <?php 
                                                $intercalar = true; 
                                                $total += $var->debe;
                                            ?>

                                            <td style=" text-align:right; color:black;">{{$var->description}}</td>
                                            <td style=" text-align:right; color:black;">{{number_format($var->debe, 2, ',', '.')}}</td>
                                            
                                            <td style=" text-align:right; color:black;">
                                                <a href="{{ route('bankmovements.createdeposit',$var->id) }}" title="Depositar"><i class="fa fa-download"></i></a>
                                                <a href="{{ route('bankmovements.createretirement',$var->id) }}" title="Retiro"><i class="fa fa-upload"></i></a>
                                                <a href="bankmovements/register/{{$var->code_one}}/{{$var->code_two}}/{{$var->code_three}}/{{$var->code_four}}/{{$var->period}}" title="Transferencia"><i class="fa fa-exchange-alt"></i></a>
                                           </td>
                                        </tr>   
                                        @endif  
                                        
                                    @endforeach   
                                    <tr>
                                       
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