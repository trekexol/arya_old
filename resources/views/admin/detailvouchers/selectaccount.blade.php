@extends('admin.layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row py-lg-2">
       
        <div class="col-md-6">
            <h2>Seleccione una Cuenta</h2>
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
<!-- container-fluid -->
<div class="container-fluid">
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
        <table class="table table-light2 table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr> 
                <th></th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Nivel</th>
                <th>Tipo</th>
                
                <th>Saldo Anterior</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Saldo Actual</th>
               
                
            </tr>
            </thead>
            
            <tbody>
                @if (empty($accounts))
                @else  
                <?php
                    $intercalar = true;
                ?>
               
                    @foreach ($accounts as $account)
                        <tr>
                        @if($intercalar)
                        <?php $intercalar = false;?>
                        <td style="text-align:right; color:black;">  
                            @if ($control == 'edit')
                                <a href="{{ route('detailvouchers.edit',[$coin,$header->id,$account->id]) }}" title="Seleccionar"><i class="fa fa-check"></i></a>
                            @else
                                <a href="{{ route('detailvouchers.create',[$coin,$header->id,$account->id]) }}" title="Seleccionar"><i class="fa fa-check"></i></a>
                            @endif
                       </td>
                            <td style="text-align:right; color:black;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}.{{ str_pad($account->code_five, 3, "0", STR_PAD_LEFT)}}</td>
                            <td style="text-align:right; color:black;">{{$account->description}}</td>
                            <td style="text-align:right; color:black;">{{$account->level}}</td>
                            <td style="text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black;">{{ number_format($account->balance_previus, 2, ',', '.') }}</td>
                            <td style="text-align:right; color:black;">{{ number_format($account->debe, 2, ',', '.') }}</td>
                            <td style="text-align:right; color:black;">{{ number_format($account->haber, 2, ',', '.') }}</td>

                            <?php $total = $account->balance_previus+$account->debe-$account->haber;?>
                            <td style="text-align:right; color:black;">{{ number_format($total, 2, ',', '.') }}</td>
                            
                            
                            
                        </tr>   

                        @else
                            <?php $intercalar = true; ?>
                            <td style="background: #E0D7CD; text-align:right; color:black;">
                                <a href="{{ route('detailvouchers.create',[$coin,$header->id,$account->id]) }}" title="Seleccionar"><i class="fa fa-check"></i></a>
                             </td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}.{{str_pad($account->code_five, 3, "0", STR_PAD_LEFT)}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->description}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->level}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{ number_format($account->balance_previus, 2, ',', '.') }}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{ number_format($account->debe, 2, ',', '.') }}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{ number_format($account->haber, 2, ',', '.') }}</td>

                            <?php $total = $account->balance_previus+$account->debe-$account->haber;?>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{ number_format($total, 2, ',', '.') }}</td>
                            
                               
                        </tr>   
                        @endif  
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
    </script>
@endsection                      
