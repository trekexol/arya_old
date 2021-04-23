@extends('layouts.dashboard')

@section('content')

@section('header')


<!-- CSS media query within a style sheet -->
<style>

  body {
   
    zoom: 80%;
  }

</style>
@endsection
<!-- container-fluid -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row py-lg-2">
        <div class="col-md-3 dropdown mb-4">
            <button class="btn btn-primary dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Niveles
            </button>
            <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Nivel 1</a>
                <a class="dropdown-item" href="#">Nivel 2</a>
                <a class="dropdown-item" href="#">Nivel 3</a>
                <a class="dropdown-item" href="#">Todos</a>
            </div>
        </div>
        <div class="col-md-3 dropdown mb-4">
            <button class="btn btn-info dropdown-toggle" type="button"
                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Opciones de Cuentas
            </button>
            <div class="dropdown-menu animated--fade-in"
                aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Listado de Cuentas</a>
                <a class="dropdown-item" href="#">Bajar Cuentas a Excel</a>
                <a class="dropdown-item" href="#">Imprimir Cuentas</a>
                <a class="dropdown-item" href="#">Subir Cuentas</a>
            </div>
        </div> 
        <div class="col-md-3">
            <a href="#" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-eye"></i>
                </span>
                <span class="text">Ver Ejercicio Anterior</span>
            </a>
        </div>
            <div class="col-md-3">
                <a href="#" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <span class="text">Cierre de Ejercicio</span>
                </a>
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
    <div class="card-header py-3 ">
        
            
        <div class="col-md-3 float-md-right">
            <a href="{{ route('accounts.create')}}" class="btn btn-primary btn-icon-splitt" role="button" aria-pressed="true">Registrar una Cuenta</a>
          </div>
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
                            
                            <td style="text-align:right; color:black;">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                            <td style="text-align:right; color:black;">{{number_format($account->debe, 2, ',', '.')}}</td>
                            <td style="text-align:right; color:black;">{{number_format($account->haber, 2, ',', '.')}}</td>

                            
                            <td style="text-align:right; color:black;">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                            
                            <td style="text-align:right; color:black;">  
                                <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>   

                        @else
                            <?php $intercalar = true; ?>

                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->code_one}}.{{$account->code_two}}.{{$account->code_three}}.{{$account->code_four}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->description}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->level}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{$account->type}}</td>
                            
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{number_format($account->balance_previus, 2, ',', '.')}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{number_format($account->debe, 2, ',', '.')}}</td>
                            <td style="background: #E0D7CD; text-align:right; color:black;">{{number_format($account->haber, 2, ',', '.')}}</td>

                            <td style="background: #E0D7CD; text-align:right; color:black;">{{number_format($account->balance_previus+$account->debe-$account->haber, 2, ',', '.')}}</td>
                            
                                <td style="background: #E0D7CD; text-align:right; color:black;">
                                <a href="accounts/register/{{$account->code_one}}/{{$account->code_two}}/{{$account->code_three}}/{{$account->code_four}}/{{$account->period}}" title="Crear"><i class="fa fa-plus"></i></a>
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

@section('javascript')

    <script>
    $('#dataTable').DataTable({
        "order": []
    });
    </script> 
@endsection