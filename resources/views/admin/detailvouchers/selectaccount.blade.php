@extends('layouts.dashboard')

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
               
                <th>Código</th>
                <th>Descripción</th>
                <th>Nivel</th>
                <th>Tipo</th>
                
                <th>Saldo Anterior</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Saldo Actual</th>
               
                <th>Tools</th>
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
                            <td style="text-align:right; color:black;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="text-align:right; color:black;">{{$account->description}}</td>
                            <td style="text-align:right; color:black;">{{$account->level}}</td>
                            <td style="text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="text-align:right; color:black;">{{$account->balance_previus}}</td>
                            <td style="text-align:right; color:black;">{{$account->debe}}</td>
                            <td style="text-align:right; color:black;">{{$account->haber}}</td>

                            
                            <td style="text-align:right; color:black;">{{$account->balance_previus+$account->debe-$account->haber}}</td>
                            
                            
                            <td style="text-align:right; color:black;">  
                                <a href="{{ route('detailvouchers.createselectaccount',[$header->id,$account->code_one,$account->code_two,$account->code_three,$account->code_four,$account->period]) }}" title="Seleccionar"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>   

                        @else
                            <?php $intercalar = true; ?>

                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->description}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->level}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->balance_previus}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->debe}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->haber}}</td>

                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->balance_previus+$account->debe-$account->haber}}</td>
                            
                                <td style="background: #E0D7CD; text-align:right; color:black;">
                                <a href="{{ route('detailvouchers.createselectaccount',[$header->id,$account->code_one,$account->code_two,$account->code_three,$account->code_four,$account->period]) }}" title="Seleccionar"><i class="fa fa-plus"></i></a>
                             </td>
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
