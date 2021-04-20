@extends('layouts.dashboard')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
      <div class="col-md-6">
          <h2>Cuentas</h2>
      </div>
      <div class="col-md-6">
        <a href="{{ route('accounts.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Registrar una Cuenta</a>
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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cuentas</h6>
    </div>
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
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr> 
               
                <th>Código</th>
                <th>Descripción</th>
                <th>Nivel</th>
                <th>Tipo</th>
                
                <th >Saldo Anterior</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Status</th>
               
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
                            <td>{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td>{{$account->description}}</td>
                            <td>{{$account->level}}</td>
                            <td>{{$account->type}}</td>
                            
                            <td>{{$account->balance_previus}}</td>
                            <td>{{$account->debe}}</td>
                            <td>{{$account->haber}}</td>

                            @if($account->status == 1)
                                <td>Activo</td>
                            @else
                                <td>Inactivo</td>
                            @endif
                            
                            <td>  
                            <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}" title="Crear"><i class="fa fa-plus"></i></a>
                           </td>
                        </tr>   

                        @else
                            <?php $intercalar = true; ?>

                            <td style="background: #E0D7CD;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="background: #E0D7CD;">{{$account->description}}</td>
                            <td style="background: #E0D7CD;">{{$account->level}}</td>
                            <td style="background: #E0D7CD;">{{$account->type}}</td>
                            
                            <td style="background: #E0D7CD;">{{$account->balance_previus}}</td>
                            <td style="background: #E0D7CD;">{{$account->debe}}</td>
                            <td style="background: #E0D7CD;">{{$account->haber}}</td>

                            @if($account->status == 1)
                                <td style="background: #E0D7CD;">Activo</td>
                            @else
                                <td style="background: #E0D7CD;">Inactivo</td>
                            @endif
                            
                                <td style="background: #E0D7CD;">
                                <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}" title="Crear"><i class="fa fa-plus"></i></a>
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
